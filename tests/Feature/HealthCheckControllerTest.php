<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

final class HealthCheckControllerTest extends TestCase
{
    public function test_healthcheck_returns_ok(): void
    {
        $response = $this->get(route('healthcheck'));

        $response->assertStatus(200);
        $response->assertJson(['status' => 'OK']);
    }
}
