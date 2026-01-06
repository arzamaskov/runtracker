<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use RunTracker\Application\Identity\Exception\UserAlreadyExistsException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo('/login');
        if (($_ENV['APP_ENV'] ?? $_SERVER['APP_ENV'] ?? 'local') === 'production') {
            $middleware->trustProxies(
                at: '*',
                headers: Request::HEADER_X_FORWARDED_FOR |
                Request::HEADER_X_FORWARDED_HOST |
                Request::HEADER_X_FORWARDED_PORT |
                Request::HEADER_X_FORWARDED_PROTO
            );
        }
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (UserAlreadyExistsException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Пользователь с таким email уже существует.']);
        });
    })->create();
