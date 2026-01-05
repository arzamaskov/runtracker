<?php

declare(strict_types=1);

namespace App\Http\Controllers\Identity\Web;

use App\Http\Requests\Identity\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use RunTracker\Application\Identity\Command\LoginUser\LoginUserCommand;
use RunTracker\Application\Identity\Exception\InvalidCredentialsException;
use RunTracker\Application\Shared\Command\CommandBus;

final readonly class LoginController
{
    public function __construct(private CommandBus $commandBus) {}

    public function __invoke(LoginRequest $request): RedirectResponse
    {
        try {
            $user = $this->commandBus->dispatch(
                new LoginUserCommand(
                    $request->validated('email'),
                    $request->validated('password')
                )
            );

            Auth::loginUsingId($user->id()->value());

            return redirect()->route('dashboard');
        } catch (InvalidCredentialsException $e) {
            throw ValidationException::withMessages([
                'email' => $e->getMessage(),
            ]);

        }
    }
}
