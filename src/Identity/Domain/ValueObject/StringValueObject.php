<?php

declare(strict_types=1);

namespace RunTracker\Identity\Domain\ValueObject;

abstract readonly class StringValueObject
{
    protected function __construct(protected string $value) {}

    final public function value(): string
    {
        return $this->value;
    }

    final public function equals(self $other): bool
    {
        return get_class($this) === get_class($other)
            && $this->value === $other->value;
    }
}
