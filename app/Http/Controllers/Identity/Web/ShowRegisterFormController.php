<?php

declare(strict_types=1);

namespace App\Http\Controllers\Identity\Web;

use Illuminate\View\View;

final class ShowRegisterFormController
{
    public function __invoke(): View
    {
        return view('identity.register');
    }
}
