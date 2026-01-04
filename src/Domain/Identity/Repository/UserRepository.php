<?php

declare(strict_types=1);

namespace RunTracker\Domain\Identity\Repository;

use RunTracker\Domain\Identity\Entity\User;
use RunTracker\Domain\Identity\ValueObject\Email;
use RunTracker\Domain\Identity\ValueObject\UserId;

interface UserRepository
{
    public function add(User $user): void;

    public function find(UserId $id): ?User;

    public function findByEmail(Email $email): ?User;
}
