<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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


// Login page
Route::get('/login', function () {
    return view('login');
})->name('login');

// Login submit
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Register submit
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/forgot-password', function () {
    return view('forgotpass');
})->name('forgotpass');

Route::get('/payment', function () {
    return view('payment');
})->name('payment');

Route::get('/confirmation', function () {
    return view('confirmation');
})->name('confirmation');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');