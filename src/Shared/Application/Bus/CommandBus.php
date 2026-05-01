<?php

declare(strict_types=1);

namespace RunTracker\Shared\Application\Bus;

interface CommandBus
{
    public function dispatch(object $command): mixed;
}
