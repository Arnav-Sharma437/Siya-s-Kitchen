<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\MenuItemController as AdminMenuItemController;
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
