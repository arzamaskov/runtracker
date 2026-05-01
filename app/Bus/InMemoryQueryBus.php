<?php

declare(strict_types=1);

namespace App\Bus;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use RunTracker\Shared\Application\Bus\QueryBus;

final readonly class InMemoryQueryBus implements QueryBus
{
    public function __construct(private QueryHandlerMap $handlerMap, private Container $container) {}

    /**
     * @throws BindingResolutionException
     */
    public function ask(object $query): mixed
    {
        $handlerClass = $this->handlerMap->handlerFor($query);
        $handler = $this->container->make($handlerClass);

        return $handler($query);
    }
}
