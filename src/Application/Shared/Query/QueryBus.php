<?php

declare(strict_types=1);

namespace RunTracker\Application\Shared\Query;

interface QueryBus
{
    public function ask(Query $query): mixed;
}
