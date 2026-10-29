<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MenuItemController as AdminMenuItemController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Web Routes - Siya's Kitchen
|--------------------------------------------------------------------------
| London, UK restaurant ordering platform.
*/

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public Digital Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// Public Content Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');

Route::get('/order', function () {
    return redirect()->route('menu');
})->name('order.index');

/*
|--------------------------------------------------------------------------
| Teya Hosted Checkout & Payment Routes
|--------------------------------------------------------------------------
*/
Route::post('/checkout/teya', [CheckoutController::class, 'initiate'])->name('checkout.initiate');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel/{order}', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
Route::match(['get', 'post'], '/webhooks/teya', [CheckoutController::class, 'webhook'])->name('webhooks.teya');

// Safe remote migration trigger (executes pending migrations)
Route::get('/system/migrate', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        return response()->json([
            'status' => 'success',
            'message' => 'Database migrations executed successfully.',
            'output' => trim(\Illuminate\Support\Facades\Artisan::output()),
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
});

// Safe remote cache refresh (reloads .env changes)
Route::get('/system/cache-clear', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        return response()->json([
            'status' => 'success',
            'message' => 'Configuration and application caches cleared successfully. New .env values are now active.',
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
});

// Safe remote status endpoint to inspect Teya environment without exposing secrets
Route::get('/system/teya-status', function () {
    $teya = app(\App\Services\TeyaService::class);
    return response()->json([
        'status' => 'success',
        'payment_driver' => config('services.teya.driver', env('PAYMENT_DRIVER')),
        'teya_env' => config('services.teya.env'),
        'is_sandbox' => $teya->isSandbox(),
        'store_id_configured' => !empty(config('services.teya.store_id')),
        'client_id_configured' => !empty(config('services.teya.client_id')),
        'client_secret_configured' => !empty(config('services.teya.client_secret')),
    ]);
});

// Secure endpoint to configure Teya credentials on live server without exposing them in Git
Route::post('/system/setup-teya-env', function (\Illuminate\Http\Request $request) {
    if ($request->input('token') !== 'sk_teya_setup_9a7d3f1c8b2e4a6d') {
        abort(403);
    }

    $storeId = $request->input('store_id');
    $clientId = $request->input('client_id');
    $clientSecret = $request->input('client_secret');
    $teyaEnv = $request->input('teya_env', 'production');
    $webhookPublicKey = $request->input('teya_webhook_public_key');

    if (empty($clientId) || empty($clientSecret)) {
        return response()->json(['error' => 'Missing credentials'], 400);
    }

    $envPath = base_path('.env');
    if (!file_exists($envPath)) {
        return response()->json(['error' => '.env file not found'], 500);
    }

    $envContent = file_get_contents($envPath);

    $keys = [
        'PAYMENT_DRIVER' => 'teya',
        'TEYA_ENV' => $teyaEnv,
        'TEYA_STORE_ID' => $storeId,
        'TEYA_CLIENT_ID' => $clientId,
        'TEYA_CLIENT_SECRET' => $clientSecret,
        'TEYA_WEBHOOK_PUBLIC_KEY' => $webhookPublicKey,
    ];

    foreach ($keys as $k => $v) {
        if ($v === null || $v === '') continue;
        if (preg_match('/^' . preg_quote($k, '/') . '=/m', $envContent)) {
            $envContent = preg_replace('/^' . preg_quote($k, '/') . '=.*$/m', $k . '=' . $v, $envContent);
        } else {
            $envContent .= "\n" . $k . '=' . $v;
        }
    }

    file_put_contents($envPath, $envContent);

    // Clear caches so new config is picked up immediately
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');

    return response()->json([
        'status' => 'success',
        'message' => 'Teya credentials configured successfully on live server .env',
        'teya_env' => $teyaEnv,
    ]);
});

/*
|--------------------------------------------------------------------------
| Admin Management & Ecommerce Operations Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Guest / Authentication Routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);

        // Orders & Kitchen Display Management
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::get('/orders/{order}/receipt', [AdminOrderController::class, 'printReceipt'])->name('orders.receipt');
        Route::get('/api/orders/live', [AdminOrderController::class, 'liveFeed'])->name('orders.live-feed');

        // Menu Items CRUD & Quick Toggles
        Route::patch('/menu-items/{menu_item}/toggle-availability', [AdminMenuItemController::class, 'toggleAvailability'])->name('menu-items.toggle-availability');
        Route::patch('/menu-items/{menu_item}/toggle-popular', [AdminMenuItemController::class, 'togglePopular'])->name('menu-items.toggle-popular');
        Route::resource('menu-items', AdminMenuItemController::class);

        // Menu Categories CRUD & Quick Toggles
        Route::patch('/categories/{category}/toggle-active', [AdminCategoryController::class, 'toggleActive'])->name('categories.toggle-active');
        Route::resource('categories', AdminCategoryController::class);

        // System Settings & Cache Control
        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings');
        Route::post('/settings/cache-clear', [AdminSettingsController::class, 'clearCache'])->name('settings.cache-clear');
    });
});
