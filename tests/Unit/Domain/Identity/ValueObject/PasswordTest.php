<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Identity\ValueObject;

use PHPUnit\Framework\TestCase;
use RunTracker\Domain\Identity\ValueObject\Password;

final class PasswordTest extends TestCase
{
    public function test_from_hash_creates_password(): void
    {
        $hash = 'hashed-password-value';

        $password = Password::fromHash($hash);

        self::assertSame($hash, $password->value());
    }

    public function test_from_hash_throws_exception_for_empty_string(): void
    {
        $emptyHash = '';

        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Password must not be empty');

        Password::fromHash($emptyHash);
    }

    public function test_from_hash_throws_exception_for_whitespace_only(): void
    {
        $spaceOnlyHash = '           ';

        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Password must not be empty');

        Password::fromHash($spaceOnlyHash);
    }
}
