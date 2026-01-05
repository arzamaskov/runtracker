<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Identity\Command\RegisterUser;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use RunTracker\Application\Identity\Command\RegisterUser\RegisterUserCommand;
use RunTracker\Application\Identity\Command\RegisterUser\RegisterUserHandler;
use RunTracker\Application\Identity\Exception\UserAlreadyExistsException;
use RunTracker\Application\Identity\Security\PasswordHasher;
use RunTracker\Domain\Identity\Entity\User;
use RunTracker\Domain\Identity\Repository\UserRepository;
use RunTracker\Domain\Identity\ValueObject\Email;
use RunTracker\Domain\Identity\ValueObject\Password;

class RegisterUserHandlerTest extends TestCase
{
    private UserRepository $userRepository;

    private PasswordHasher $passwordHasher;

    private RegisterUserHandler $handler;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->passwordHasher = $this->createMock(PasswordHasher::class);
        $this->handler = new RegisterUserHandler(
            $this->userRepository,
            $this->passwordHasher,
        );
    }

    public function test_it_registers_new_user(): void
    {
        $command = new RegisterUserCommand('test@example.com', 'password123');

        $this->userRepository
            ->method('findByEmail')
            ->willReturn(null);

        $this->passwordHasher
            ->method('hash')
            ->with('password123')
            ->willReturn('hashed_password');

        $this->userRepository
            ->expects($this->once())
            ->method('add')
            ->with($this->isInstanceOf(User::class));

        $this->handler->handle($command);
    }

    /**
     * @throws Exception
     */
    public function test_it_throws_exception_when_email_already_exists(): void
    {
        $command = new RegisterUserCommand('existing@example.com', 'password123');

        $existingUser = User::register(
            Email::fromString('existing@example.com'),
            Password::fromHash('some_hash'),
        );

        $this->userRepository
            ->method('findByEmail')
            ->willReturn($existingUser);

        $this->userRepository
            ->expects($this->never())
            ->method('add');

        $this->expectException(UserAlreadyExistsException::class);

        $this->handler->handle($command);
    }
}
