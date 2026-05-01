<?php

declare(strict_types=1);

namespace Tests\Feature\Providers;

use App\Bus\InMemoryCommandBus;
use App\Bus\InMemoryQueryBus;
use Illuminate\Contracts\Container\BindingResolutionException;
use RunTracker\Shared\Application\Bus\CommandBus;
use RunTracker\Shared\Application\Bus\QueryBus;
use Tests\TestCase;

class BusServiceProviderTest extends TestCase
{
    /**
     * @throws BindingResolutionException
     */
    public function test_it_registers_command_and_query_buses(): void
    {
        $this->assertInstanceOf(
            InMemoryCommandBus::class,
            $this->app->make(CommandBus::class),
        );

        $this->assertInstanceOf(
            InMemoryQueryBus::class,
            $this->app->make(QueryBus::class),
        );
    }
}
