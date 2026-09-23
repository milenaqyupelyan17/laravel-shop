<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingsController;

Route::get('/', [ProductController::class, 'home'])
    ->name('home');

Route::get('/products', [ProductController::class, 'index'])
    ->name('products');

Route::get('/categories', function () {
    return view('categories');
})->name('categories');

Route::get('/product-details/{id}', [ProductController::class, 'show'])
    ->name('productdetails');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/help', function () {
    return view('help');
})->name('help');

Route::get('/404', function () {
    return view('404');
})->name('404');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

Route::get('/card', function () {
    return view('card');
})->middleware('auth')->name('card');

Route::get('/sign-in', function () {
    return view('sign_in');
})->name('login');

Route::post('/sign_in', [AuthController::class, 'login'])
    ->name('login.post');

Route::get('/sign_up', function () {
    return view('sign_up');
})->name('register.form');

Route::post('/sign_up', [AuthController::class, 'register'])
    ->name('register');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/forgot-password', function () {
    return view('forgotpass');
})->name('forgotpass');

Route::get('/payment', function () {
    return view('payment');
})->middleware('auth')->name('payment');

Route::post('/payment', [OrderController::class, 'store'])
    ->middleware('auth')
    ->name('payment.store');

Route::get('/confirmation', [OrderController::class, 'confirmation'])
    ->middleware('auth')
    ->name('confirmation');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/favorites', function () {
    return view('favorites');
})->middleware('auth')->name('favorites');

Route::get('/settings', function () {
    return view('settings');
})->middleware('auth')->name('settings');

Route::put('/settings', [SettingsController::class, 'update'])
    ->middleware('auth')
    ->name('settings.update');

Route::get('/carts', function () {

    $orders = auth()->user()
        ->orders()
        ->with('items.product')
        ->latest()
        ->get();

    return view('carts', compact('orders'));
})->middleware('auth')->name('carts');

Route::get('/orders', function () {

    $orders = auth()->user()
        ->orders()
        ->with('items.product')
        ->latest()
        ->get();

    return view('orders', compact('orders'));
})->middleware('auth')->name('orders');

Route::post('/newsletter', [NewsletterController::class, 'store'])
    ->name('newsletter.store');
