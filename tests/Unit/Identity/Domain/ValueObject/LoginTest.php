<?php

declare(strict_types=1);

namespace Tests\Unit\Identity\Domain\ValueObject;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RunTracker\Identity\Domain\ValueObject\Login;

class LoginTest extends TestCase
{
    public function test_it_creates_valid_login(): void
    {
        $login = Login::from('user login');
        $this->assertSame('user login', $login->value());
    }

    public function test_it_throws_exception_for_empty_login(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Login cannot be empty');

        Login::from('   ');
    }

    public function test_it_throws_exception_for_too_long_login(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Login cannot be longer than 100 characters');

        Login::from(
            'very very very very very very very very very very very very very'.
            'very very very very very very very very very very very long login'
        );
    }

    public function test_it_normalizes_login_to_lowercase(): void
    {
        $login = Login::from('USER login');
        $this->assertSame('user login', $login->value());
    }

    public function test_it_trims_and_normalizes_login(): void
    {
        $login = Login::from('   USER login   ');
        $this->assertSame('user login', $login->value());
    }
}
