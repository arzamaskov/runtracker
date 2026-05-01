<?php

declare(strict_types=1);

namespace App\Bus;

use App\Bus\Exception\HandlerNotFoundException;

final readonly class QueryHandlerMap
{
    public function __construct(private array $handlers) {}

    public function handlerFor(object $query): string
    {
        $queryClass = $query::class;
        if (! isset($this->handlers[$queryClass])) {
            throw new HandlerNotFoundException($queryClass);
        }

        return $this->handlers[$queryClass];
    }
}
