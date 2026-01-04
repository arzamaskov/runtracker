<?php

declare(strict_types=1);

namespace App\Security;

use RunTracker\Application\Identity\Security\PasswordHasher;

final readonly class ArgonPasswordHasher implements PasswordHasher
{
    public function hash(string $plainPassword): string
    {
        return password_hash($plainPassword, PASSWORD_ARGON2ID);
    }

    public function verify(string $plainPassword, string $hashedPassword): bool
    {
        return password_verify($plainPassword, $hashedPassword);
    }
}
