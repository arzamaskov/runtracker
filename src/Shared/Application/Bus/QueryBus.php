<?php

declare(strict_types=1);

namespace RunTracker\Shared\Application\Bus;

interface QueryBus
{
    public function ask(object $query): mixed;
}
