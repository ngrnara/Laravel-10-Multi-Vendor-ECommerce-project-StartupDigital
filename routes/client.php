<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;

Route::prefix('account')->name('client.')->group(function () {

    Route::middleware('guest:client')->group(function () {
        Route::get('/login', [ClientController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [ClientController::class, 'login'])->name('login-handler');
        Route::get('/register', [ClientController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [ClientController::class, 'register'])->name('register-handler');
    });

    Route::middleware('auth:client')->group(function () {
        Route::post('/logout', [ClientController::class, 'logout'])->name('logout');

        // Route untuk mengakses halaman riwayat transaksi client
        Route::get('/orders', [ClientController::class, 'orders'])->name('orders');

        Route::prefix('checkout')->name('checkout.')->group(function () {
            Route::get('/cities/{province}', [CheckoutController::class, 'getCities'])->name('cities');
            Route::get('/success/{order}', [CheckoutController::class, 'success'])->name('success');
            Route::get('/{product}', [CheckoutController::class, 'index'])->name('index');
            Route::post('/{product}', [CheckoutController::class, 'store'])->name('store');
        });
    });

});

// Cart routes — di luar grup 'account', pakai prefix/nama sendiri
Route::middleware('auth:client')->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{product}', [CartController::class, 'store'])->name('add');
    Route::put('/{cartItem}', [CartController::class, 'update'])->name('update');
    Route::delete('/{cartItem}', [CartController::class, 'destroy'])->name('destroy');

    Route::get('/checkout', [CheckoutController::class, 'cartCheckout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'cartCheckoutStore'])->name('checkout.store');
});
