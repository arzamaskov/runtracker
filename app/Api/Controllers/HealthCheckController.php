<?php

declare(strict_types=1);

namespace App\Api\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class HealthCheckController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'OK'], Response::HTTP_OK);
    }
}
