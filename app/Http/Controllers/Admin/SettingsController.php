<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TeyaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Display the Admin Settings & System Overview.
     */
    public function index(TeyaService $teyaService): View
    {
        $teya = [
            'env' => config('services.teya.env', 'production'),
            'is_sandbox' => $teyaService->isSandbox(),
            'store_id' => config('services.teya.store_id'),
            'client_id_configured' => !empty(config('services.teya.client_id')),
            'client_secret_configured' => !empty(config('services.teya.client_secret')),
            'webhook_url' => url('/webhooks/teya'),
        ];

        $appInfo = [
            'name' => config('app.name', "Siya's Kitchen"),
            'env' => config('app.env'),
            'url' => config('app.url'),
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
        ];

        return view('admin.settings.index', compact('teya', 'appInfo'));
    }

    /**
     * Clear application caches.
     */
    public function clearCache(): RedirectResponse
    {
        try {
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');

            return back()->with('success', 'All system caches have been cleared successfully.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Failed to clear caches: ' . $e->getMessage());
        }
    }
}
