<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Identity\ValueObject;

use PHPUnit\Framework\TestCase;
use RunTracker\Domain\Identity\ValueObject\UserId;
use Symfony\Component\Uid\Uuid;

final class UserIdTest extends TestCase
{
    public function test_generate_creates_valid_uuid(): void
    {
        $userId = UserId::generate();

        self::assertTrue(
            Uuid::isValid($userId->value()),
            'Generated UserId must be a valid UUID'
        );
    }

    public function test_from_string_creates_user_id_from_valid_uuid(): void
    {
        $validUuid = Uuid::v7()->toRfc4122();
        $userId = UserId::fromString($validUuid);

        self::assertEquals(
            $userId->value(),
            $validUuid,
            'Generated UserId must be a valid UUID'
        );
    }

    public function test_from_string_throws_exception_for_invalid_uuid(): void
    {
        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid user ID');

        UserId::fromString('invalid-uuid');
    }

    public function test_equals_returns_true_for_same_id(): void
    {
        $validUuid = Uuid::v7()->toRfc4122();
        $userId = UserId::fromString($validUuid);
        $otherUserId = UserId::fromString($validUuid);

        self::assertEquals($userId->value(), $otherUserId->value());
        self::assertTrue($userId->equals($otherUserId));
    }

    public function test_equals_returns_false_for_different_ids(): void
    {
        $userId = UserId::generate();
        $otherUserId = UserId::generate();

        self::assertFalse($userId->equals($otherUserId));
    }
}
