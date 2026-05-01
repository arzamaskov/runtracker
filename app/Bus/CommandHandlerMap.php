<?php

declare(strict_types=1);

namespace App\Bus;

use App\Bus\Exception\HandlerNotFoundException;

final readonly class CommandHandlerMap
{
    public function __construct(private array $handlers) {}

    public function handlerFor(object $command): string
    {
        $commandClass = $command::class;
        if (! isset($this->handlers[$commandClass])) {
            throw new HandlerNotFoundException($commandClass);
        }

        return $this->handlers[$commandClass];
    }
}
