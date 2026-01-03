<?php

declare(strict_types=1);

namespace RunTracker\Domain\Identity\ValueObject;

use InvalidArgumentException;
use Symfony\Component\Uid\Uuid;

final readonly class UserId
{
    public function __construct(private Uuid $id) {}

    public static function generate(): self
    {
        return new self(Uuid::v7());
    }

    public static function fromString(string $id): UserId
    {
        if (! Uuid::isValid($id)) {
            throw new InvalidArgumentException('Invalid user ID');
        }

        return new self(Uuid::fromString($id));
    }

    public function value(): string
    {
        return $this->id->toRfc4122();
    }

    public function equals(self $other): bool
    {
        return $this->id->toString() === $other->value();
    }
}
