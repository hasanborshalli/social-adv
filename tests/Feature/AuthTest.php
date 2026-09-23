<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('login'));

        $response->assertOk();
    }

    public function test_register_screen_can_be_rendered(): void
    {
        $response = $this->get(route('register'));

        $response->assertOk();
    }

    public function test_users_can_authenticate_with_email(): void
    {
        $user = User::factory()->create([
            'password' => 'password',
        ]);

        $response = $this->post(route('login'), [
            'identifier' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('feed'));
    }

    public function test_users_can_authenticate_with_username(): void
    {
        $user = User::factory()->create([
            'password' => 'password',
        ]);

        $response = $this->post(route('login'), [
            'identifier' => $user->username,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('feed'));
    }

    public function test_users_cannot_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'password' => 'password',
        ]);

        $response = $this->post(route('login'), [
            'identifier' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('identifier');
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Jane Doe',
            'username' => 'jane_doe',
            'email' => 'jane@example.com',
            'password' => 'password12345',
            'password_confirmation' => 'password12345',
            'birthday' => '2000-01-01',
            'terms' => '1',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('feed'));

        $user = User::whereEmail('jane@example.com')->firstOrFail();
        $this->assertTrue(Hash::check('password12345', $user->password));
    }

    public function test_registration_requires_matching_password_confirmation(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Jane Doe',
            'username' => 'jane_doe',
            'email' => 'jane@example.com',
            'password' => 'password12345',
            'password_confirmation' => 'different-password',
            'birthday' => '2000-01-01',
            'terms' => '1',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('password');
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $this->assertGuest();
        $response->assertRedirect(route('login'));
    }

    /**
     * @return array<string, array<int, string>>
     */
    public static function protectedRoutes(): array
    {
        return [
            'profile' => ['profile'],
            'friends' => ['friends'],
            'messages' => ['messages'],
            'notifications' => ['notifications'],
            'settings' => ['settings'],
        ];
    }

    #[DataProvider('protectedRoutes')]
    public function test_guests_are_redirected_to_login_from_protected_routes(string $routeName): void
    {
        $response = $this->get(route($routeName));

        $response->assertRedirect(route('login'));
    }

    #[DataProvider('protectedRoutes')]
    public function test_authenticated_users_can_visit_protected_routes(string $routeName): void
    {
        $response = $this->actingAs(User::factory()->create())->get(route($routeName));

        $response->assertOk();
    }
}
