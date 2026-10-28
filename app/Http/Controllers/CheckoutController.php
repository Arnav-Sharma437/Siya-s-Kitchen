<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\TeyaService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    /**
     * Initiate Teya Hosted Checkout Session.
     * Server-side price recalculation guarantees client-side cart tampering is prevented.
     */
    public function initiate(Request $request, TeyaService $teyaService): JsonResponse
    {
        $validated = $request->validate([
            'order_type' => 'required|in:dine_in,takeaway',
            'table_number' => 'nullable|string|max:20',
            'customer_name' => 'nullable|string|max:100',
            'customer_email' => 'nullable|email|max:120',
            'customer_phone' => 'nullable|string|max:30',
            'special_instructions' => 'nullable|string|max:500',
            'cart' => 'required|array|min:1',
            'cart.*.menuItemId' => 'required|integer',
            'cart.*.quantity' => 'required|integer|min:1|max:50',
            'cart.*.variation' => 'nullable|array',
            'cart.*.variation.name' => 'nullable|string',
            'cart.*.addons' => 'nullable|array',
            'cart.*.addons.*.name' => 'nullable|string',
            'cart.*.specialInstructions' => 'nullable|string|max:255',
        ]);

        if ($validated['order_type'] === 'dine_in' && empty($validated['table_number'])) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide a valid table number for Dine-In ordering.',
            ], 422);
        }

        // Auto-heal: Ensure orders and order_items tables exist on live database
        if (!Schema::hasTable('orders') || !Schema::hasTable('order_items')) {
            try {
                Artisan::call('migrate', ['--force' => true]);
                Log::info('Auto-migrated database: orders and order_items tables created.');
            } catch (\Throwable $e) {
                Log::error('Auto-migration failed: ' . $e->getMessage());
            }
        }

        try {
            DB::beginTransaction();

            $subtotalPence = 0;
            $orderItemsData = [];
            $teyaLineItems = [];

            // 1. Fetch and lock menu items
            $itemIds = collect($validated['cart'])->pluck('menuItemId')->unique()->toArray();
            $menuItems = MenuItem::with(['variations', 'addons'])
                ->whereIn('id', $itemIds)
                ->where('is_available', true)
                ->get()
                ->keyBy('id');

            foreach ($validated['cart'] as $clientItem) {
                $menuItemId = $clientItem['menuItemId'];
                $menuItem = $menuItems->get($menuItemId);

                if (!$menuItem) {
                    throw new Exception("One or more selected dishes are currently unavailable.");
                }

                $quantity = (int) $clientItem['quantity'];
                $unitPricePence = $menuItem->price;
                $variationName = null;
                $variationPricePence = null;

                // Validate Portion Variation
                if (!empty($clientItem['variation']['name'])) {
                    $selectedVariationName = $clientItem['variation']['name'];
                    $variationModel = $menuItem->variations
                        ->where('name', $selectedVariationName)
                        ->where('is_active', true)
                        ->first();

                    if ($variationModel) {
                        $unitPricePence = $variationModel->price;
                        $variationName = $variationModel->name;
                        $variationPricePence = $variationModel->price;
                    }
                }

                // Validate Add-ons
                $validatedAddons = [];
                if (!empty($clientItem['addons']) && is_array($clientItem['addons'])) {
                    foreach ($clientItem['addons'] as $clientAddon) {
                        $addonName = $clientAddon['name'] ?? null;
                        if ($addonName) {
                            $addonModel = $menuItem->addons
                                ->where('name', $addonName)
                                ->where('is_active', true)
                                ->first();

                            if ($addonModel) {
                                $unitPricePence += $addonModel->price;
                                $validatedAddons[] = [
                                    'name' => $addonModel->name,
                                    'price' => $addonModel->price,
                                ];
                            }
                        }
                    }
                }

                $lineTotalPence = $unitPricePence * $quantity;
                $subtotalPence += $lineTotalPence;

                $orderItemsData[] = [
                    'menu_item_id' => $menuItem->id,
                    'item_name' => $menuItem->name,
                    'variation_name' => $variationName,
                    'variation_price_pence' => $variationPricePence,
                    'addons_json' => !empty($validatedAddons) ? $validatedAddons : null,
                    'special_instructions' => $clientItem['specialInstructions'] ?? null,
                    'unit_price_pence' => $unitPricePence,
                    'quantity' => $quantity,
                    'line_total_pence' => $lineTotalPence,
                ];

                // Build line item description for Teya Hosted Checkout page
                $desc = $menuItem->name;
                if ($variationName) {
                    $desc .= " ({$variationName})";
                }
                if (!empty($validatedAddons)) {
                    $addonNames = implode(', ', array_column($validatedAddons, 'name'));
                    $desc .= " + {$addonNames}";
                }

                $teyaLineItems[] = [
                    'description' => mb_substr($desc, 0, 100),
                    'quantity' => $quantity,
                    'unit_price' => $unitPricePence,
                ];
            }

            if ($subtotalPence <= 0) {
                throw new Exception("Invalid order total amount.");
            }

            // VAT is included in UK menu pricing
            $vatPence = (int) round($subtotalPence - ($subtotalPence / 1.20));
            $totalPence = $subtotalPence;

            // Generate human-friendly order reference
            $orderNumber = 'SK-' . date('ymd') . '-' . strtoupper(Str::random(4));

            $order = Order::create([
                'order_number' => $orderNumber,
                'order_type' => $validated['order_type'],
                'table_number' => $validated['table_number'] ?? null,
                'customer_name' => $validated['customer_name'] ?? null,
                'customer_email' => $validated['customer_email'] ?? null,
                'customer_phone' => $validated['customer_phone'] ?? null,
                'special_instructions' => $validated['special_instructions'] ?? null,
                'subtotal_pence' => $subtotalPence,
                'vat_pence' => $vatPence,
                'total_pence' => $totalPence,
                'currency' => 'GBP',
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'payment_driver' => 'teya',
            ]);

            foreach ($orderItemsData as $itemData) {
                $order->items()->create($itemData);
            }

            // 2. Request Teya Hosted Checkout Session
            $successUrl = route('checkout.success', ['order' => $order->order_number]);
            $cancelUrl = route('checkout.cancel', ['order' => $order->order_number]);
            $failureUrl = route('checkout.cancel', ['order' => $order->order_number, 'failed' => 1]);

            // Note: Teya's AWS WAF blocks literal 'localhost' and '127.0.0.1' in redirect URLs (SSRF protection).
            // We rewrite any local address to 'localtest.me' (which resolves to 127.0.0.1 on the user's machine)
            // or use services.teya.return_url_base (e.g. live domain or ngrok) if explicitly configured.
            $returnUrlBase = config('services.teya.return_url_base');

            if (!empty($returnUrlBase)) {
                $targetBase = rtrim($returnUrlBase, '/');
                $successUrl = $targetBase . parse_url($successUrl, PHP_URL_PATH);
                $cancelUrl = $targetBase . parse_url($cancelUrl, PHP_URL_PATH);
                $failureUrl = $targetBase . parse_url($failureUrl, PHP_URL_PATH) . '?failed=1';
            } else {
                $isLocal = preg_match('#://(localhost|127\.0\.0\.1|\[::1\])#i', $successUrl);
                if ($isLocal) {
                    $successUrl = preg_replace('#://(localhost|127\.0\.0\.1|\[::1\])#i', '://localtest.me', $successUrl);
                    $cancelUrl = preg_replace('#://(localhost|127\.0\.0\.1|\[::1\])#i', '://localtest.me', $cancelUrl);
                    $failureUrl = preg_replace('#://(localhost|127\.0\.0\.1|\[::1\])#i', '://localtest.me', $failureUrl);
                } elseif (request()->isSecure()) {
                    // If accessed over HTTPS, ensure redirect URLs use HTTPS
                    $successUrl = preg_replace('#^http://#i', 'https://', $successUrl);
                    $cancelUrl = preg_replace('#^http://#i', 'https://', $cancelUrl);
                    $failureUrl = preg_replace('#^http://#i', 'https://', $failureUrl);
                }
            }

            $sessionPayload = [
                'amount' => [
                    'currency' => 'GBP',
                    'value' => $totalPence,
                ],
                'type' => 'SALE',
                'store_id' => config('services.teya.store_id'),
                'merchant_reference' => $order->order_number,
                'line_items' => $teyaLineItems,
                'metadata' => [
                    'order_id' => (string) $order->id,
                    'order_number' => $order->order_number,
                    'order_type' => $order->order_type,
                    'table_number' => (string) ($order->table_number ?? ''),
                ],
                'language' => 'en-GB',
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
                'failure_url' => $failureUrl,
                'post_success_payment' => 'REDIRECT',
            ];

            // Format phone number to international E.164 (+44...) for Teya API
            $formattedPhone = null;
            if (!empty($order->customer_phone)) {
                $cleaned = preg_replace('/[^\d+]/', '', $order->customer_phone);
                if (str_starts_with($cleaned, '0')) {
                    $cleaned = '+44' . substr($cleaned, 1);
                } elseif (!str_starts_with($cleaned, '+')) {
                    $cleaned = '+44' . $cleaned;
                }
                if (preg_match('/^\+[1-9]\d{6,14}$/', $cleaned)) {
                    $formattedPhone = $cleaned;
                }
            }

            // Add customer details if provided
            $customerData = array_filter([
                'name' => $order->customer_name ?: null,
                'email' => $order->customer_email ?: null,
                'phone_number' => $formattedPhone,
            ]);
            if (!empty($customerData)) {
                $sessionPayload['customer'] = $customerData;
            }

            $sessionResponse = $teyaService->createCheckoutSession($sessionPayload);

            $sessionId = $sessionResponse['session_id'] ?? null;
            $sessionUrl = $sessionResponse['session_url'] ?? null;

            if (empty($sessionId) || empty($sessionUrl)) {
                throw new Exception("Invalid response from Teya Hosted Checkout.");
            }

            $order->update([
                'teya_session_id' => $sessionId,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'order_number' => $order->order_number,
                'session_id' => $sessionId,
                'redirect_url' => $sessionUrl,
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Checkout initiation failed', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'An error occurred while creating your checkout session. Please try again.',
            ], 400);
        }
    }

    /**
     * Customer return route upon successful payment redirect from Teya.
     */
    public function success(Request $request, string $orderNumber, TeyaService $teyaService): View
    {
        $order = Order::with('items.menuItem')
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        // If order status is still pending, verify directly with Teya's session API
        if ($order->status === 'pending' && !empty($order->teya_session_id)) {
            try {
                $sessionInfo = $teyaService->getCheckoutSession($order->teya_session_id);
                $paymentStatus = strtoupper($sessionInfo['payment_status'] ?? '');

                if ($paymentStatus === 'SUCCESS') {
                    $transactionId = $sessionInfo['transaction_id'] ?? $sessionInfo['payment_link_id'] ?? null;
                    $order->markAsPaid($transactionId);
                }
            } catch (Exception $e) {
                Log::warning('Could not verify Teya session on success redirect', [
                    'order' => $order->order_number,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return view('checkout.success', [
            'order' => $order,
        ]);
    }

    /**
     * Customer return route when checkout was cancelled or payment failed.
     */
    public function cancel(Request $request, string $orderNumber): View
    {
        $order = Order::with('items')
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        $isFailed = $request->query('failed') == 1;

        if ($order->status === 'pending') {
            if ($isFailed) {
                $order->markAsFailed();
            } else {
                $order->markAsCancelled();
            }
        }

        return view('checkout.cancel', [
            'order' => $order,
            'isFailed' => $isFailed,
        ]);
    }

    /**
     * Teya Webhook notification handler.
     * Verifies SHA256withRSA signature and updates order status idempotently.
     */
    public function webhook(Request $request, TeyaService $teyaService): JsonResponse
    {
        // Respond to browser and monitoring GET requests with health status
        if ($request->isMethod('get')) {
            return response()->json([
                'status' => 'active',
                'service' => 'Teya Webhook Listener',
                'description' => 'Siya\'s Kitchen payment notification listener. Ready to receive POST events from Teya.',
                'timestamp' => now()->toIso8601String(),
            ]);
        }

        $rawPayload = $request->getContent();
        $signature = $request->header('x-teya-signature') ?: $request->header('X-Teya-Signature');

        Log::info('Teya webhook received', [
            'has_signature' => !empty($signature),
            'content_length' => strlen($rawPayload),
        ]);

        $publicKey = config('services.teya.webhook_public_key');
        $isProduction = !$teyaService->isSandbox();

        // Verify cryptographic signature if public key is configured
        if (!empty($publicKey)) {
            if (empty($signature)) {
                Log::warning('Teya webhook rejected: Missing signature header');
                return response()->json(['error' => 'Missing signature'], 401);
            }

            $decodedSignature = base64_decode($signature);
            $verified = openssl_verify($rawPayload, $decodedSignature, $publicKey, OPENSSL_ALGO_SHA256);

            if ($verified !== 1) {
                Log::warning('Teya webhook rejected: Invalid signature');
                return response()->json(['error' => 'Invalid signature'], 401);
            }
        }

        $payload = json_decode($rawPayload, true);
        if (!$payload || !isset($payload['event'])) {
            return response()->json(['error' => 'Invalid JSON'], 400);
        }

        $event = $payload['event'] ?? '';

        // Process successful payment notification
        if ($event === 'payment.succeeded.v1') {
            $data = $payload['data'] ?? [];
            $merchantReference = $data['merchantreference'] ?? null;
            $sessionId = $data['sessionid'] ?? null;
            $transactionId = $data['transactionid'] ?? null;
            $authCode = $data['authorisationcode'] ?? null;

            $order = null;
            if ($merchantReference) {
                $order = Order::where('order_number', $merchantReference)->first();
            }
            if (!$order && $sessionId) {
                $order = Order::where('teya_session_id', $sessionId)->first();
            }

            if ($order) {
                if ($order->status === 'paid') {
                    // Idempotent: already marked as paid
                    return response()->json(['status' => 'already_paid'], 200);
                }

                // In production, if cryptographic public key signature wasn't verified,
                // double-check payment status directly with Teya's official API before trusting
                if ($isProduction && empty($publicKey)) {
                    if (empty($sessionId)) {
                        Log::error('Teya webhook rejected: Cannot verify payment without public key or session_id');
                        return response()->json(['error' => 'Unverified webhook payment rejected'], 403);
                    }
                    try {
                        $sessionInfo = $teyaService->getCheckoutSession($sessionId);
                        $apiPaymentStatus = strtoupper($sessionInfo['payment_status'] ?? '');
                        if ($apiPaymentStatus !== 'SUCCESS') {
                            Log::warning('Teya webhook rejected: API session status is not SUCCESS', [
                                'api_status' => $apiPaymentStatus,
                                'session_id' => $sessionId,
                            ]);
                            return response()->json(['error' => 'Payment status unconfirmed by Teya API'], 400);
                        }
                    } catch (Exception $e) {
                        Log::error('Teya webhook verification against API failed: ' . $e->getMessage());
                        return response()->json(['error' => 'Unable to verify payment with Teya API'], 500);
                    }
                }

                $order->markAsPaid($transactionId, $authCode);

                Log::info('Order successfully marked as paid via Teya webhook', [
                    'order_number' => $order->order_number,
                    'transaction_id' => $transactionId,
                ]);
            } else {
                Log::warning('Teya webhook received for unknown order', [
                    'merchant_reference' => $merchantReference,
                    'session_id' => $sessionId,
                ]);
            }
        }

        return response()->json(['status' => 'received'], 200);
    }
}
