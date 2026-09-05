<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index'])
    ->name('products');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/categories', function () {
    return view('categories');
})->name('categories');


Route::get('/product-details', function () {
    return view('productdetails');
})->name('productdetails');

Route::get('/card', function () {
    return view('card');
})->name('card');


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
