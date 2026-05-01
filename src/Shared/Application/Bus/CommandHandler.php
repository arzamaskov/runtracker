<?php

declare(strict_types=1);

namespace RunTracker\Shared\Application\Bus;

interface CommandHandler
{
    public function __invoke(object $command): mixed;
}
