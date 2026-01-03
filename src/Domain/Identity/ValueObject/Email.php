<?php

declare(strict_types=1);

namespace RunTracker\Domain\Identity\ValueObject;

use InvalidArgumentException;

final readonly class Email
{
    private function __construct(private string $email)
    {
        $this->validate($email);
    }

    public static function fromString(string $email): self
    {
        return new self(strtolower($email));
    }

    public function value(): string
    {
        return $this->email;
    }

    public function equals(self $other): bool
    {
        return $this->email === $other->email;
    }

    private function validate(string $email): void
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email address');
        }
    }
}
