<?php

declare(strict_types=1);

use App\Api\Controllers\HealthCheckController;
use Illuminate\Support\Facades\Route;

Route::get('/healthcheck', HealthCheckController::class)->name('healthcheck');
