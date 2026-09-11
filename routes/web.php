<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;

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
})->name('payment');

Route::get('/confirmation', function () {
    return view('confirmation');
})->name('confirmation');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/favorites', function () {
    return view('favorites');
})->name('favorites');
