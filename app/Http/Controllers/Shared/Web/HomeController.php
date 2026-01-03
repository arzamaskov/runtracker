<?php

declare(strict_types=1);

namespace App\Http\Controllers\Shared\Web;

use Illuminate\View\View;

final class HomeController
{
    public function __invoke(): View
    {
        return view('shared.home');
    }
}
