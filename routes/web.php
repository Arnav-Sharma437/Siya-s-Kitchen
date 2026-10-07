<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\MenuItemController as AdminMenuItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
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

// Static / Placeholder public pages
Route::get('/about', function () {
    return redirect()->route('home')->with('info', 'About section available on homepage.');
})->name('about');

Route::get('/gallery', function () {
    return redirect()->route('home')->with('info', 'Gallery section available on homepage.');
})->name('gallery');

Route::get('/contact', function () {
    return redirect()->route('home')->with('info', 'Contact details available in footer.');
})->name('contact');

Route::get('/order', function () {
    return redirect()->route('menu')->with('info', 'Browse our digital menu to explore all available dishes.');
})->name('order.index');

/*
|--------------------------------------------------------------------------
| Admin Architecture Foundation Routes
|--------------------------------------------------------------------------
| Structured for future authentication / permissions middleware binding.
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/menu-items');

    // Menu Categories CRUD Architecture
    Route::resource('categories', AdminCategoryController::class);

    // Menu Items CRUD Architecture
    Route::resource('menu-items', AdminMenuItemController::class);
});
