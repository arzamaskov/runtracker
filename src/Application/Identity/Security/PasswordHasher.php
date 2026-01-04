<?php

declare(strict_types=1);

namespace RunTracker\Application\Identity\Security;

interface PasswordHasher
{
    public function hash(string $plainPassword): string;

    public function verify(string $plainPassword, string $hashedPassword): bool;
}
