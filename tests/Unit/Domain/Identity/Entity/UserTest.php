<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Identity\Entity;

use PHPUnit\Framework\TestCase;
use RunTracker\Domain\Identity\Entity\User;
use RunTracker\Domain\Identity\ValueObject\Email;
use RunTracker\Domain\Identity\ValueObject\Password;
use RunTracker\Domain\Identity\ValueObject\UserId;

final class UserTest extends TestCase
{
    public function test_register_creates_user_with_generated_id(): void
    {
        $email = Email::fromString('valid@email.com');
        $password = Password::fromHash('password-hash');

        $user = User::register($email, $password);

        self::assertInstanceOf(UserId::class, $user->id());
    }

    public function test_restore_creates_user_with_given_data(): void
    {
        $email = Email::fromString('restore@email.com');
        $password = Password::fromHash('password-hash');
        $id = UserId::generate();

        $user = User::restore($id, $email, $password);

        self::assertEquals($email, $user->email());
    }

    public function test_change_password_updates_password(): void
    {
        $email = Email::fromString('valid@email.com');
        $password = Password::fromHash('password-hash');
        $newPassword = Password::fromHash('new-password-hash');

        $user = User::register($email, $password);

        self::assertSame($password, $user->password());

        $user->changePassword($newPassword);

        self::assertSame($newPassword, $user->password());
    }

    public function test_change_email_updates_email(): void
    {
        $email = Email::fromString('old@email.com');
        $newEmail = Email::fromString('new@email.com');
        $password = Password::fromHash('password-hash');

        $user = User::register($email, $password);

        self::assertSame($email, $user->email());

        $user->changeEmail($newEmail);

        self::assertSame($newEmail, $user->email());
    }
}
