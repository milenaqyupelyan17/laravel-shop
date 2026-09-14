<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;


Route::get('/', [ProductController::class, 'home'])
    ->name('home');

Route::get('/products', [ProductController::class, 'index'])
    ->name('products');

Route::get('/categories', function () {
    return view('categories');
})->name('categories');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

Route::get('/product-details/{id}', [ProductController::class, 'show'])
    ->name('productdetails');

Route::get('/card', function () {
    return view('card');
})->name('card');

Route::get('/help', function () {
    return view('help');
})->name('help');

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

Route::get('/confirmation', function () {
    return view('confirmation');
})->name('confirmation');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/favorites', function () {
    return view('favorites');
})->name('favorites');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/settings', function () {
    return view('settings');
})->middleware('auth')->name('settings');

Route::put('/settings', [AuthController::class, 'updateSettings'])
    ->middleware('auth')
    ->name('settings.update');

Route::post('/newsletter', [NewsletterController::class, 'store'])
    ->name('newsletter.store');

Route::get('/carts', function () {
    return view('carts');
})->name('carts');
