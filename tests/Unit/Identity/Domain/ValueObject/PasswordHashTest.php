<?php

declare(strict_types=1);

namespace Tests\Unit\Identity\Domain\ValueObject;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RunTracker\Identity\Domain\ValueObject\PasswordHash;

class PasswordHashTest extends TestCase
{
    public function test_it_creates_valid_password_hash(): void
    {
        $hash = password_hash('password', PASSWORD_ARGON2ID);
        $passwordHash = PasswordHash::from($hash);
        $this->assertSame($hash, $passwordHash->value());
    }

    public function test_it_throws_exception_for_invalid_password_hash(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid password hash');

        PasswordHash::from('not-valid-hash');
    }
}
