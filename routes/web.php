<?php

use App\Http\Controllers\HealthCheckController;
use Illuminate\Support\Facades\Route;

Route::get('/healthcheck', HealthCheckController::class);

Route::get('/', function () {
    return view('welcome');
});
