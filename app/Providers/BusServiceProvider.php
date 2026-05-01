<?php

declare(strict_types=1);

namespace App\Providers;

use App\Bus\CommandHandlerMap;
use App\Bus\InMemoryCommandBus;
use App\Bus\InMemoryQueryBus;
use App\Bus\QueryHandlerMap;
use Illuminate\Support\ServiceProvider;
use RunTracker\Shared\Application\Bus\CommandBus;
use RunTracker\Shared\Application\Bus\QueryBus;

final class BusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CommandBus::class, InMemoryCommandBus::class);
        $this->app->singleton(QueryBus::class, InMemoryQueryBus::class);

        $this->app->singleton(CommandHandlerMap::class, fn () => new CommandHandlerMap([
            //
        ]));

        $this->app->singleton(QueryHandlerMap::class, fn () => new QueryHandlerMap([
            //
        ]));
    }
}
