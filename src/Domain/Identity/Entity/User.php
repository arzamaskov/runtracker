<?php

declare(strict_types=1);

namespace RunTracker\Domain\Identity\Entity;

use RunTracker\Domain\Identity\ValueObject\Email;
use RunTracker\Domain\Identity\ValueObject\Password;
use RunTracker\Domain\Identity\ValueObject\UserId;

final class User
{
    private function __construct(private readonly UserId $id, private Email $email, private Password $password) {}

    public static function register(Email $email, Password $password): User
    {
        return new self(UserId::generate(), $email, $password);
    }

    public static function restore(UserId $id, Email $email, Password $password): User
    {
        return new self($id, $email, $password);
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): Password
    {
        return $this->password;
    }

    public function changePassword(Password $newPassword): void
    {
        $this->password = $newPassword;
    }

    public function changeEmail(Email $newEmail): void
    {
        $this->email = $newEmail;
    }
}
