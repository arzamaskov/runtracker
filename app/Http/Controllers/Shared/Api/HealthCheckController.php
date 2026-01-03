<?php

declare(strict_types=1);

namespace App\Http\Controllers\Shared\Api;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class HealthCheckController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'OK'], Response::HTTP_OK);
    }
}
