<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Identity\Web;

use App\Models\User;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(ValidateCsrfToken::class);
    }

    public function test_registration_form_is_displayed(): void
    {
        $response = $this->get(route('identity.register'));

        $response->assertStatus(200);
        $response->assertViewIs('identity.register');
    }

    public function test_user_can_register(): void
    {
        $response = $this->from(route('identity.register'))
            ->post(route('identity.register.submit'), [
                'email' => 'test@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    public function test_user_cannot_register_with_existing_email(): void
    {
        User::factory()->create(['email' => 'existing@example.com']);

        $response = $this->from(route('identity.register'))
            ->post(route('identity.register.submit'), [
                'email' => 'existing@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ]);

        $response->assertRedirect(route('identity.register'));
        $response->assertSessionHasErrors(['email']);
    }

    public function test_user_cannot_register_with_invalid_data(): void
    {
        $response = $this->from(route('identity.register'))
            ->post(route('identity.register.submit'), [
                'email' => 'invalid-email',
                'password' => 'short',
                'password_confirmation' => 'different',
            ]);

        $response->assertRedirect(route('identity.register'));
        $response->assertSessionHasErrors(['email', 'password']);
    }
}
