<?php

declare(strict_types=1);

namespace RunTracker\Identity\Domain\ValueObject;

use InvalidArgumentException;

final readonly class UserId extends StringValueObject
{
    public static function from(string $ulid): self
    {
        if (preg_match('/^[0-7][0-9A-HJKMNP-TV-Z]{25}$/', $ulid) !== 1) {
            throw new InvalidArgumentException('Invalid user id');
        }

        return new self($ulid);
    }
}
