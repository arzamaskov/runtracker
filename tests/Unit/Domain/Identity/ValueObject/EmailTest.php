<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Identity\ValueObject;

use PHPUnit\Framework\TestCase;
use RunTracker\Domain\Identity\ValueObject\Email;

final class EmailTest extends TestCase
{
    public function test_from_string_creates_email(): void
    {
        $email = 'valid@email.com';
        $emailObject = Email::fromString($email);

        self::assertEquals($email, $emailObject->value());
    }

    public function test_from_string_normalizes_to_lowercase(): void
    {
        $email = 'User@Example.COM';
        $sameEmail = 'user@example.com';

        $emailObject = Email::fromString($email);

        self::assertEquals($sameEmail, $emailObject->value());
    }

    public function test_from_string_throws_exception_for_invalid_email(): void
    {
        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid email address');

        Email::fromString('invalid-email');
    }

    public function test_equals_returns_true_for_same_email(): void
    {
        $email = 'user@example.com';
        $emailObject = Email::fromString($email);
        $sameEmailObject = Email::fromString($email);

        self::assertTrue($emailObject->equals($sameEmailObject));
    }

    public function test_equals_returns_false_for_different_emails(): void
    {
        $email = 'user@example.com';
        $emailObject = Email::fromString($email);
        $differentEmail = 'different@example.com';
        $differentEmailObject = Email::fromString($differentEmail);

        self::assertFalse($emailObject->equals($differentEmailObject));
    }
}
