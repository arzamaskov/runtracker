<?php

use App\Http\Controllers\Identity\Web\LoginController;
use App\Http\Controllers\Identity\Web\LogoutController;
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
    Route::post('/logout', LogoutController::class)->name('identity.logout');

    Route::get('/dashboard', function () {
        return view('dashboard.overview');
    })->name('dashboard');

    Route::get('/dashboard/activities', function () {
        return view('dashboard.activities');
    })->name('dashboard.activities');

    Route::get('/dashboard/stats', function () {
        return view('dashboard.stats');
    })->name('dashboard.stats');

    Route::get('/dashboard/comparison', function () {
        return view('dashboard.comparison');
    })->name('dashboard.comparison');

    Route::get('/dashboard/goals', function () {
        return view('dashboard.goals');
    })->name('dashboard.goals');

    Route::get('/dashboard/settings', function () {
        return view('dashboard.settings');
    })->name('dashboard.settings');
});
