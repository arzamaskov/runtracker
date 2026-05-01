<?php

declare(strict_types=1);

namespace RunTracker\Identity\Domain\ValueObject;

final readonly class PasswordHash extends StringValueObject
{
    public static function from(string $passwordHash): self
    {
        if (! password_get_info($passwordHash)['algo']) {
            throw new \InvalidArgumentException('Invalid password hash');
        }

        return new self($passwordHash);
    }
}
