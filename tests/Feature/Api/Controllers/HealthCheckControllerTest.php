<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class HealthCheckControllerTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get(route('healthcheck'));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(['status' => 'OK']);
    }
}
