<?php

declare(strict_types=1);

namespace App\Providers;

use App\Security\ArgonPasswordHasher;
use Illuminate\Support\ServiceProvider;
use RunTracker\Application\Identity\Security\PasswordHasher;

final class SecurityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PasswordHasher::class, ArgonPasswordHasher::class);
    }
}
