<?php

declare(strict_types=1);

namespace RunTracker\Shared\Application\Bus;

interface QueryHandler
{
    public function __invoke(object $query): mixed;
}
