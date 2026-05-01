<?php

declare(strict_types=1);

namespace App\Bus;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use RunTracker\Shared\Application\Bus\CommandBus;

final readonly class InMemoryCommandBus implements CommandBus
{
    public function __construct(private CommandHandlerMap $handlerMap, private Container $container) {}

    /**
     * @throws BindingResolutionException
     */
    public function dispatch(object $command): mixed
    {
        $handlerClass = $this->handlerMap->handlerFor($command);
        $handler = $this->container->make($handlerClass);

        return $handler($command);
    }
}
