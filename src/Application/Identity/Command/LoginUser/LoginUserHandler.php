<?php

declare(strict_types=1);

namespace RunTracker\Application\Identity\Command\LoginUser;

use RunTracker\Application\Identity\Exception\InvalidCredentialsException;
use RunTracker\Application\Identity\Security\PasswordHasher;
use RunTracker\Domain\Identity\Entity\User;
use RunTracker\Domain\Identity\Repository\UserRepository;
use RunTracker\Domain\Identity\ValueObject\Email;

final readonly class LoginUserHandler
{
    public function __construct(private UserRepository $userRepository, private PasswordHasher $passwordHasher) {}

    public function handle(LoginUserCommand $command): User
    {
        $email = Email::fromString($command->email);

        $user = $this->userRepository->findByEmail($email);

        if ($user === null) {
            throw new InvalidCredentialsException;
        }

        if (! $this->passwordHasher->verify($command->password, $user->password()->value())) {
            throw new InvalidCredentialsException;
        }

        return $user;
    }
}
