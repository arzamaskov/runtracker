<?php

use App\Http\Controllers\Identity\Web\RegisterController;
use App\Http\Controllers\Identity\Web\ShowRegisterFormController;
use App\Http\Controllers\Shared\Web\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/register', ShowRegisterFormController::class)->name('identity.register');
    Route::post('/register', RegisterController::class)->name('identity.register.submit');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
