<?php

declare(strict_types=1);

namespace App\Http\Controllers\Identity\Web;

use App\Http\Requests\Identity\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use RunTracker\Application\Identity\Command\RegisterUser\RegisterUserCommand;
use RunTracker\Application\Shared\Command\CommandBus;

final readonly class RegisterController
{
    public function __construct(private CommandBus $commandBus) {}

    public function __invoke(RegisterRequest $request): RedirectResponse
    {
        $this->commandBus->dispatch(
            new RegisterUserCommand(
                $request->validated('email'),
                $request->validated('password'),
            )
        );

        Auth::attempt([
            'email' => $request->validated('email'),
            'password' => $request->validated('password'),
        ]);

        return redirect()->route('dashboard');
    }
}
