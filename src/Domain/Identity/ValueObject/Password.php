<?php

declare(strict_types=1);

namespace RunTracker\Domain\Identity\ValueObject;

use InvalidArgumentException;

final readonly class Password
{
    private function __construct(private string $password)
    {
        $this->validate($password);
    }

    public static function fromHash(string $password): self
    {
        return new self($password);
    }

    public function value(): string
    {
        return $this->password;
    }

    private function validate(string $password): void
    {
        if (trim($password) === '') {
            throw new InvalidArgumentException('Password must not be empty');
        }
    }
}
