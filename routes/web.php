<?php

use App\Http\Controllers\Identity\Web\LoginController;
use App\Http\Controllers\Identity\Web\RegisterController;
use App\Http\Controllers\Identity\Web\ShowLoginFormController;
use App\Http\Controllers\Identity\Web\ShowRegisterFormController;
use App\Http\Controllers\Shared\Web\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/register', ShowRegisterFormController::class)->name('identity.register');
    Route::post('/register', RegisterController::class)->name('identity.register.submit');
    Route::get('/login', ShowLoginFormController::class)->name('identity.login');
    Route::post('/login', LoginController::class)->name('identity.login.submit');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
