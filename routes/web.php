
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;

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

Route::middleware('guest')->group(function () {

    Route::get('/sign-in', function () {
        return view('sign_in');
    })->name('login');

    Route::post('/sign_in', [LoginController::class, 'login'])
        ->name('login.post');

    Route::get('/sign_up', function () {
        return view('sign_up');
    })->name('register.form');

    Route::post('/sign_up', [RegisterController::class, 'register'])
        ->name('register');

    Route::get('/forgot-password', function () {
        return view('forgotpass');
    })->name('forgotpass');
});

Route::middleware('auth')->group(function () {


    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/card', function () {
        return view('card');
    })->name('card');

    Route::get('/payment', function () {
        return view('payment');
    })->name('payment');

    Route::post('/payment', [OrderController::class, 'store'])
        ->name('payment.store');

    Route::get('/confirmation', [OrderController::class, 'confirmation'])
        ->name('confirmation');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('auth')
        ->name('dashboard');

    Route::get('/favorites', function () {
        return view('favorites');
    })->name('favorites');

    Route::get('/settings', [SettingsController::class, 'index'])
        ->name('settings');

    Route::put('/settings', [SettingsController::class, 'update'])
        ->name('settings.update');

    Route::get('/carts', function () {

        $orders = auth()->user()
            ->orders()
            ->with('items.product')
            ->latest()
            ->get();

        return view('carts', compact('orders'));
    })->name('carts');

    Route::get('/orders', function () {

        $orders = auth()->user()
            ->orders()
            ->with('items.product')
            ->latest()
            ->get();

        return view('orders', compact('orders'));
    })->name('orders');

    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])
        ->name('orders.cancel');
});

Route::post('/newsletter', [NewsletterController::class, 'store'])
    ->name('newsletter.store');
