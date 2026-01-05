<?php

declare(strict_types=1);

namespace RunTracker\Application\Identity\Command\RegisterUser;

use RunTracker\Application\Shared\Command\Command;

final readonly class RegisterUserCommand implements Command
{
    public function __construct(public string $email, public string $password) {}
}
