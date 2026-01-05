<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User as UserModel;
use RunTracker\Domain\Identity\Entity\User;
use RunTracker\Domain\Identity\Repository\UserRepository;
use RunTracker\Domain\Identity\ValueObject\Email;
use RunTracker\Domain\Identity\ValueObject\Password;
use RunTracker\Domain\Identity\ValueObject\UserId;

final readonly class EloquentUserRepository implements UserRepository
{
    public function add(User $user): void
    {
        UserModel::query()->create([
            'id' => $user->id()->value(),
            'email' => $user->email()->value(),
            'password' => $user->password()->value(),
        ]);
    }

    public function find(UserId $id): ?User
    {
        $model = UserModel::query()->find($id->value());

        if ($model === null) {
            return null;
        }

        return $this->toDomain($model);
    }

    public function findByEmail(Email $email): ?User
    {
        $model = UserModel::query()->where('email', $email->value())->first();

        if ($model === null) {
            return null;
        }

        return $this->toDomain($model);
    }

    private function toDomain(UserModel $model): User
    {
        return User::restore(
            UserId::fromString($model->id),
            Email::fromString($model->email),
            Password::fromHash($model->password),
        );
    }
}
