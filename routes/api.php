<?php

use App\Http\Controllers\Shared\Api\HealthCheckController;
use Illuminate\Support\Facades\Route;

Route::get('/healthcheck', HealthCheckController::class)->name('healthcheck');
