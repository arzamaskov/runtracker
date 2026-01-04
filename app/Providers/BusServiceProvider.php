<?php

declare(strict_types=1);

namespace App\Providers;

use App\Bus\LaravelCommandBus;
use App\Bus\LaravelQueryBus;
use Illuminate\Support\ServiceProvider;
use RunTracker\Application\Shared\Command\CommandBus;
use RunTracker\Application\Shared\Query\QueryBus;

final class BusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CommandBus::class, LaravelCommandBus::class);
        $this->app->singleton(QueryBus::class, LaravelQueryBus::class);
    }
}
