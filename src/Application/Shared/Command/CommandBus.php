<?php

declare(strict_types=1);

namespace RunTracker\Application\Shared\Command;

interface CommandBus
{
    public function dispatch(Command $command): mixed;
}
