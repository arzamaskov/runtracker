<?php

declare(strict_types=1);

namespace RunTracker\Application\Identity\Command\RegisterUser;

use RunTracker\Application\Identity\Exception\UserAlreadyExistsException;
use RunTracker\Application\Identity\Security\PasswordHasher;
use RunTracker\Domain\Identity\Entity\User;
use RunTracker\Domain\Identity\Repository\UserRepository;
use RunTracker\Domain\Identity\ValueObject\Email;
use RunTracker\Domain\Identity\ValueObject\Password;

final readonly class RegisterUserHandler
{
    public function __construct(private UserRepository $userRepository, private PasswordHasher $passwordHasher) {}

    public function handle(RegisterUserCommand $command): void
    {
        $email = Email::fromString($command->email);

        if ($this->userRepository->findByEmail($email) !== null) {
            throw new UserAlreadyExistsException($email);
        }

        $hashedPassword = $this->passwordHasher->hash($command->password);
        $password = Password::fromHash($hashedPassword);

        $user = User::register($email, $password);

        $this->userRepository->add($user);
    }
}
