<?php

declare(strict_types=1);

namespace App\Http\Controllers\Identity\Web;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class LogoutController
{
    public function __invoke(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('identity.login');
    }
}
