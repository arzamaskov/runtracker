<?php

declare(strict_types=1);

namespace RunTracker\Identity\Domain\ValueObject;

use InvalidArgumentException;

final readonly class Login extends StringValueObject
{
    public static function from(string $login): self
    {
        $normalized = strtolower(trim($login));
        if ($normalized === '') {
            throw new InvalidArgumentException('Login cannot be empty');
        }

        if (strlen($normalized) > 100) {
            throw new InvalidArgumentException('Login cannot be longer than 100 characters');
        }

        return new self($normalized);
    }
}
