<?php

declare(strict_types=1);

namespace Tests\Unit\Bus;

use App\Bus\InMemoryQueryBus;
use App\Bus\QueryHandlerMap;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

class InMemoryQueryBusTest extends TestCase
{
    /**
     * @throws BindingResolutionException
     */
    public function test_it_dispatches_query_to_mapped_handler(): void
    {
        $query = new InMemoryDummyQuery;

        $bus = new InMemoryQueryBus(
            new QueryHandlerMap([
                InMemoryDummyQuery::class => InMemoryDummyQueryHandler::class,
            ]),
            $this->app,
        );

        $this->assertSame('handled', $bus->ask($query));
    }
}

final class InMemoryDummyQuery {}

final class InMemoryDummyQueryHandler
{
    public function __invoke(InMemoryDummyQuery $query): string
    {
        return 'handled';
    }
}
