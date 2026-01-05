<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Identity\Web;

use App\Models\User;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

final class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(ValidateCsrfToken::class);
    }

    public function test_login_form_is_displayed(): void
    {
        $response = $this->get(route('identity.login'));

        $response->assertStatus(200);
        $response->assertViewIs('identity.login');
    }

    public function test_user_can_login(): void
    {
        $existingUser = User::factory()->create(
            [
                'email' => 'existing@example.com',
                'password' => Hash::make('password'),
            ],
        );
        $response = $this->from(route('identity.login'))
            ->post(route('identity.login.submit'), [
                'email' => 'existing@example.com',
                'password' => 'password',
            ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        User::factory()->create(['email' => 'existing@example.com']);

        $response = $this->from(route('identity.login'))
            ->post(route('identity.login.submit'), [
                'email' => 'existing@example.com',
                'password' => 'password123',
            ]);

        $response->assertRedirect(route('identity.login'));
        $response->assertSessionHasErrors();
    }

    public function test_user_cannot_login_with_invalid_data(): void
    {
        $response = $this->from(route('identity.login'))
            ->post(route('identity.login.submit'), [
                'email' => 'invalid-email',
                'password' => 'password',
            ]);

        $response->assertRedirect(route('identity.login'));
        $response->assertSessionHasErrors(['email']);
    }

    public function test_user_cannot_login_with_empty_fields(): void
    {
        $response = $this->from(route('identity.login'))
            ->post(route('identity.login.submit'), [
                'email' => '',
                'password' => '',
            ]);

        $response->assertRedirect(route('identity.login'));
        $response->assertSessionHasErrors(['email', 'password']);
    }

    public function test_user_cannot_login_with_nonexistent_email(): void
    {
        $response = $this->from(route('identity.login'))
            ->post(route('identity.login.submit'), [
                'email' => 'nonexistent@example.com',
                'password' => 'password',
            ]);

        $response->assertRedirect(route('identity.login'));
        $response->assertSessionHasErrors(['email']);
    }
}
