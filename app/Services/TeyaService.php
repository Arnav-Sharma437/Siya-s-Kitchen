<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class TeyaService
{
    protected string $environment;
    protected string $oauthUrl;
    protected string $baseApiUrl;
    protected ?string $storeId;
    protected ?string $clientId;
    protected ?string $clientSecret;
    protected string $userAgent;

    public function __construct()
    {
        $this->environment = config('services.teya.env', 'sandbox');
        $this->storeId = config('services.teya.store_id');
        $this->clientId = config('services.teya.client_id');
        $this->clientSecret = config('services.teya.client_secret');
        $this->userAgent = 'SiyasKitchen-Integration/1.0';

        if ($this->environment === 'production') {
            $this->oauthUrl = 'https://id.teya.com/oauth/v2/oauth-token';
            $this->baseApiUrl = 'https://api.teya.com';
        } else {
            // Test / Staging / Sandbox environment
            $this->oauthUrl = 'https://id.teya.xyz/oauth/v2/oauth-token';
            $this->baseApiUrl = 'https://api.teya.xyz';
        }
    }

    /**
     * Check if current configuration is in sandbox/test mode.
     */
    public function isSandbox(): bool
    {
        return $this->environment !== 'production';
    }

    /**
     * Retrieve a valid OAuth bearer access token using client_credentials grant.
     * Caches the token based on expires_in to reduce redundant API roundtrips.
     *
     * @throws Exception
     */
    public function getAccessToken(bool $forceRefresh = false): string
    {
        if (empty($this->clientId) || empty($this->clientSecret)) {
            throw new Exception('Teya API credentials are not configured.');
        }

        $cacheKey = 'teya_access_token_' . md5($this->clientId . '_' . $this->environment);

        if (!$forceRefresh) {
            try {
                if (Cache::has($cacheKey)) {
                    $cachedToken = Cache::get($cacheKey);
                    if (!empty($cachedToken)) {
                        return $cachedToken;
                    }
                }
            } catch (Throwable $e) {
                // Ignore cache read failures and proceed with fresh request
            }
        }

        $response = Http::asForm()
            ->withHeaders([
                'Accept' => 'application/json',
                'User-Agent' => $this->userAgent,
            ])
            ->timeout(15)
            ->post($this->oauthUrl, [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope' => 'checkout/sessions/create checkout/sessions/id/get refunds/create',
            ]);

        if (!$response->successful()) {
            $statusCode = $response->status();
            $errorBody = $response->json();
            $errorMessage = $errorBody['error_description'] ?? $errorBody['error'] ?? $errorBody['message'] ?? 'Authentication failed';

            Log::error('Teya OAuth token request failed', [
                'status' => $statusCode,
                'environment' => $this->environment,
                'error' => $errorMessage,
            ]);

            throw new Exception("Teya authentication error (HTTP {$statusCode}): {$errorMessage}");
        }

        $tokenData = $response->json();
        $accessToken = $tokenData['access_token'] ?? null;
        $expiresIn = (int) ($tokenData['expires_in'] ?? 3600);

        if (empty($accessToken)) {
            throw new Exception('Teya OAuth response did not contain an access_token.');
        }

        // Try caching the token with safety margin, degrade gracefully if cache driver is unavailable
        try {
            $ttlSeconds = max(60, $expiresIn - 120);
            Cache::put($cacheKey, $accessToken, now()->addSeconds($ttlSeconds));
        } catch (Throwable $e) {
            Log::warning('Unable to cache Teya access token: ' . $e->getMessage());
        }

        return $accessToken;
    }

    /**
     * Create a Teya Hosted Checkout Session.
     *
     * @param array $payload Order and checkout session parameters
     * @param string|null $idempotencyKey Optional unique key to identify request
     * @return array Response from Teya containing session_id and session_url
     * @throws Exception
     */
    public function createCheckoutSession(array $payload, ?string $idempotencyKey = null): array
    {
        $token = $this->getAccessToken();
        $idempotencyKey = $idempotencyKey ?: Str::uuid()->toString();

        if (empty($payload['store_id']) && !empty($this->storeId)) {
            $payload['store_id'] = $this->storeId;
        }

        if (empty($payload['type'])) {
            $payload['type'] = 'SALE';
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Idempotency-Key' => $idempotencyKey,
            'User-Agent' => $this->userAgent,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])
            ->timeout(20)
            ->post($this->baseApiUrl . '/v2/checkout/sessions', $payload);

        if (!$response->successful()) {
            $statusCode = $response->status();
            $errorData = $response->json();
            $errorMessage = $errorData['description'] ?? $errorData['message'] ?? $errorData['code'] ?? 'Failed to create checkout session';

            Log::error('Teya create checkout session failed', [
                'status' => $statusCode,
                'error' => $errorMessage,
            ]);

            throw new Exception("Teya checkout error (HTTP {$statusCode}): {$errorMessage}");
        }

        return $response->json();
    }

    /**
     * Retrieve status and details of an existing Hosted Checkout Session.
     *
     * @param string $sessionId
     * @return array
     * @throws Exception
     */
    public function getCheckoutSession(string $sessionId): array
    {
        $token = $this->getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'User-Agent' => $this->userAgent,
            'Accept' => 'application/json',
        ])
            ->timeout(15)
            ->get($this->baseApiUrl . '/v2/checkout/sessions/' . urlencode($sessionId));

        if (!$response->successful()) {
            $statusCode = $response->status();
            throw new Exception("Teya get session error (HTTP {$statusCode})");
        }

        return $response->json();
    }

    /**
     * Safely test OAuth authentication without logging or returning sensitive values.
     *
     * @return array Diagnostic information (sanitized)
     */
    public function testAuthentication(): array
    {
        try {
            // Force refresh to ensure we actually hit Teya's OAuth endpoint
            $token = $this->getAccessToken(forceRefresh: true);

            return [
                'success' => true,
                'environment' => $this->environment,
                'oauth_endpoint' => $this->oauthUrl,
                'token_received' => !empty($token),
                'token_length' => strlen($token),
                'has_store_id' => !empty($this->storeId),
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'environment' => $this->environment,
                'oauth_endpoint' => $this->oauthUrl,
                'token_received' => false,
                'error' => $e->getMessage(),
                'has_store_id' => !empty($this->storeId),
            ];
        }
    }
}
