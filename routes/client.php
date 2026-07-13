<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CheckoutController;

Route::prefix('account')->name('client.')->group(function () {

    Route::middleware('guest:client')->group(function () {
        Route::get('/login', [ClientController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [ClientController::class, 'login'])->name('login-handler');
        Route::get('/register', [ClientController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [ClientController::class, 'register'])->name('register-handler');
    });

    Route::middleware('auth:client')->group(function () {
        Route::post('/logout', [ClientController::class, 'logout'])->name('logout');

        Route::prefix('checkout')->name('checkout.')->group(function () {
            Route::get('/cities/{province}', [CheckoutController::class, 'getCities'])->name('cities');
            Route::get('/success/{order}', [CheckoutController::class, 'success'])->name('success');
            Route::get('/{product}', [CheckoutController::class, 'index'])->name('index');
            Route::post('/{product}', [CheckoutController::class, 'store'])->name('store');
        });
    });

});
