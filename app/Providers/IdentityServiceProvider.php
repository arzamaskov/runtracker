<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;
use RunTracker\Domain\Identity\Repository\UserRepository;

final class IdentityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(UserRepository::class, EloquentUserRepository::class);
    }
}
