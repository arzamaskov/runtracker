<?php

declare(strict_types=1);

namespace Tests\Unit\Identity\Domain\ValueObject;

use Illuminate\Support\Str;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RunTracker\Identity\Domain\ValueObject\UserId;

class UserIdTest extends TestCase
{
    public function test_it_creates_user_id_from_valid_ulid(): void
    {
        $ulid = Str::ulid()->toBase32();
        $userId = UserId::from($ulid);
        $this->assertSame($userId->value(), $ulid);
    }

    public function test_it_throws_exception_for_invalid_ulid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid user id');

        UserId::from('not-a-uuid');
    }

    public function test_it_compares_user_ids_by_value(): void
    {
        $ulid1 = Str::ulid()->toBase32();
        $ulid2 = Str::ulid()->toBase32();

        $userId1 = UserId::from($ulid1);
        $userId1_copy = UserId::from($ulid1);
        $userId2 = UserId::from($ulid2);

        $this->assertTrue($userId1->equals($userId1_copy));
        $this->assertFalse($userId1->equals($userId2));
    }
}
