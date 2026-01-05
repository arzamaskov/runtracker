<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Identity\Command\LoginUser;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use RunTracker\Application\Identity\Command\LoginUser\LoginUserCommand;
use RunTracker\Application\Identity\Command\LoginUser\LoginUserHandler;
use RunTracker\Application\Identity\Exception\InvalidCredentialsException;
use RunTracker\Application\Identity\Security\PasswordHasher;
use RunTracker\Domain\Identity\Entity\User;
use RunTracker\Domain\Identity\Repository\UserRepository;
use RunTracker\Domain\Identity\ValueObject\Email;
use RunTracker\Domain\Identity\ValueObject\Password;

final class LoginUserHandlerTest extends TestCase
{
    private UserRepository $userRepository;

    private PasswordHasher $passwordHasher;

    private LoginUserHandler $handler;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->passwordHasher = $this->createMock(PasswordHasher::class);
        $this->handler = new LoginUserHandler(
            $this->userRepository,
            $this->passwordHasher,
        );
    }

    public function test_it_logins_user(): void
    {
        $command = new LoginUserCommand('test@example.com', 'password123');

        $existingUser = User::register(
            Email::fromString('test@example.com'),
            Password::fromHash('hashed_password'),
        );

        $this->userRepository
            ->method('findByEmail')
            ->willReturn($existingUser);

        $this->passwordHasher
            ->method('verify')
            ->with('password123', 'hashed_password')
            ->willReturn(true);

        $result = $this->handler->handle($command);

        $this->assertSame($existingUser, $result);
    }

    public function test_it_throws_exception_when_password_is_invalid(): void
    {
        $command = new LoginUserCommand('existing@example.com', 'password123');

        $existingUser = User::register(
            Email::fromString('existing@example.com'),
            Password::fromHash('some_hash'),
        );

        $this->passwordHasher
            ->method('verify')
            ->willReturn(false);

        $this->userRepository
            ->method('findByEmail')
            ->willReturn($existingUser);

        $this->expectException(InvalidCredentialsException::class);

        $this->handler->handle($command);
    }

    public function test_it_throws_exception_when_user_not_found(): void
    {
        $command = new LoginUserCommand('existing@example.com', 'password123');

        $this->userRepository
            ->method('findByEmail')
            ->willReturn(null);

        $this->expectException(InvalidCredentialsException::class);

        $this->handler->handle($command);
    }
}
