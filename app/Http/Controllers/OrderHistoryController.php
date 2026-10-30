<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderHistoryController extends Controller
{
    /**
     * Display customer order history lookup and list.
     */
    public function index(Request $request): View
    {
        $rawSearch = trim((string) ($request->query('phone') ?? $request->query('search') ?? session('customer_phone') ?? ''));
        $orders = collect();
        $searched = false;

        if (!empty($rawSearch)) {
            $searched = true;
            $orders = $this->findOrders($rawSearch);

            // Store search in session for convenience
            if ($orders->isNotEmpty()) {
                session(['customer_phone' => $rawSearch]);
            }
        }

        return view('customer.orders', [
            'orders' => $orders,
            'searched' => $searched,
            'searchedPhone' => $rawSearch,
        ]);
    }

    /**
     * Handle phone number search submission.
     */
    public function lookup(Request $request): RedirectResponse
    {
        $phone = trim((string) $request->input('phone', ''));

        if (empty($phone)) {
            return redirect()->route('orders.track')->with('error', 'Please enter your mobile number or order reference.');
        }

        session(['customer_phone' => $phone]);

        return redirect()->route('orders.track', ['phone' => $phone]);
    }

    /**
     * Clear saved phone from session.
     */
    public function clear(): RedirectResponse
    {
        session()->forget('customer_phone');
        return redirect()->route('orders.track');
    }

    /**
     * Find genuine orders matching phone number variations or order reference.
     */
    protected function findOrders(string $input)
    {
        $cleanDigits = preg_replace('/\D/', '', $input);
        $cleanText = strtoupper(trim(preg_replace('/[^A-Za-z0-9\-]/', '', $input)));

        // Build phone variations (e.g. 07123..., +447123..., 447123...)
        $phoneVariations = [];
        if (!empty($cleanDigits) && strlen($cleanDigits) >= 7) {
            $phoneVariations[] = $cleanDigits;
            if (str_starts_with($cleanDigits, '44') && strlen($cleanDigits) >= 11) {
                $phoneVariations[] = '0' . substr($cleanDigits, 2);
                $phoneVariations[] = '+' . $cleanDigits;
            } elseif (str_starts_with($cleanDigits, '0') && strlen($cleanDigits) >= 10) {
                $phoneVariations[] = '44' . substr($cleanDigits, 1);
                $phoneVariations[] = '+44' . substr($cleanDigits, 1);
                $phoneVariations[] = substr($cleanDigits, 1);
            }
        }

        return Order::with(['items.menuItem'])
            ->where(function ($query) use ($phoneVariations, $cleanText) {
                if (!empty($phoneVariations)) {
                    $query->where(function ($sub) use ($phoneVariations) {
                        foreach ($phoneVariations as $var) {
                            $sub->orWhere('customer_phone', 'like', "%{$var}%");
                        }
                    });
                }

                // Also allow lookup by Order Reference (e.g. SK-261029-MLDO)
                if (str_starts_with($cleanText, 'SK-') || strlen($cleanText) >= 7) {
                    $query->orWhere('order_number', $cleanText);
                }
            })
            // Only genuine paid or active kitchen orders
            ->where(function ($query) {
                $query->whereIn('status', ['paid', 'preparing', 'ready', 'completed'])
                      ->orWhere('payment_status', 'paid');
            })
            ->latest()
            ->take(25)
            ->get();
    }
}
