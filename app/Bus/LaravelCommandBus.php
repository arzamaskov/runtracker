<?php

declare(strict_types=1);

namespace App\Bus;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use RunTracker\Application\Shared\Command\Command;
use RunTracker\Application\Shared\Command\CommandBus;

final readonly class LaravelCommandBus implements CommandBus
{
    public function __construct(private Container $container) {}

    /**
     * @throws BindingResolutionException
     */
    public function dispatch(Command $command): mixed
    {
        $handlerClass = $this->resolveHandler($command);
        $handler = $this->container->make($handlerClass);

        return $handler->handle($command);
    }

    private function resolveHandler(Command $command): string
    {
        $commandClass = $command::class;

        return preg_replace('/Command$/', 'Handler', $commandClass);
    }
}
