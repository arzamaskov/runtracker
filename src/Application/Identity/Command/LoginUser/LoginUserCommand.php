<?php

declare(strict_types=1);

namespace RunTracker\Application\Identity\Command\LoginUser;

use RunTracker\Application\Shared\Command\Command;

final readonly class LoginUserCommand implements Command
{
    public function __construct(public string $email, public string $password) {}
}
