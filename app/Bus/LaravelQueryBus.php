<?php

declare(strict_types=1);

namespace App\Bus;

use Illuminate\Contracts\Container\Container;
use RunTracker\Application\Shared\Query\Query;
use RunTracker\Application\Shared\Query\QueryBus;

final class LaravelQueryBus implements QueryBus
{
    public function __construct(private readonly Container $container) {}

    public function ask(Query $query): mixed
    {
        $queryClass = $this->resolveHandler($query);
        $handler = $this->container->make($queryClass);

        return $handler->handle($query);
    }

    private function resolveHandler(Query $query): string
    {
        $queryClass = $query::class;

        return preg_replace('/Query$/', 'Handler', $queryClass);
    }
}
