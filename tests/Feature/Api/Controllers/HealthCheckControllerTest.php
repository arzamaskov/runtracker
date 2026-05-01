<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class HealthCheckControllerTest extends TestCase
{
    public function test_healthcheck_returns_ok(): void
    {
        $response = $this->get(route('healthcheck'));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(['status' => 'OK']);
    }
}
