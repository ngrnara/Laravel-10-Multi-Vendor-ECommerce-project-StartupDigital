<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::prefix('account')->name('client.')->group(function () {

    Route::middleware('guest:client')->group(function () {
        Route::get('/login', [ClientController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [ClientController::class, 'login'])->name('login-handler');
        Route::get('/register', [ClientController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [ClientController::class, 'register'])->name('register-handler');
    });

    Route::middleware('auth:client')->group(function () {
        Route::post('/logout', [ClientController::class, 'logout'])->name('logout');
    });

});
