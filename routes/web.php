<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Suyas Kitchen
|--------------------------------------------------------------------------
| Public and ordering routes are declared with scalable architecture.
| Future steps will bind MenuController, CartController, OrderController,
| TableOrderController, Admin controllers, and Payment/POS integrations.
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Placeholder route names for navigation references (to be implemented in subsequent phases)
Route::get('/menu', function () {
    return redirect()->route('home')->with('info', 'Full digital menu coming soon.');
})->name('menu');

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
    return redirect()->route('home')->with('info', 'Online ordering system is launching in the next phase.');
})->name('order.index');
