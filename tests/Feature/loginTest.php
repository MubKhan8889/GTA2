<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_login_with_valid_credentials()
    {
        // Create a test user
        $user = User::factory()->create([
            'name' => 'testuser',
            'password' => Hash::make('password123'), // Ensure the password is hashed
        ]);

        // Send a login request
        $response = $this->post(route('login'), [
            'name' => 'testuser',
            'password' => 'password123',
        ]);

        // Assert user is redirected to the intended location (e.g., dashboard)
        $response->assertRedirect(route('dashboard'));

        // Assert the user is authenticated
        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function user_cannot_login_with_invalid_credentials()
    {
        // Create a test user
        $user = User::factory()->create([
            'name' => 'testuser',
            'password' => Hash::make('password123'),
        ]);

        // Send a login request with incorrect password
        $response = $this->post(route('login'), [
            'name' => 'testuser',
            'password' => 'wrongpassword',
        ]);

        // Assert user is not authenticated
        $this->assertGuest();

        // Assert validation error
        $response->assertSessionHasErrors(['name']);
    }

    #[Test]
    public function remember_me_functionality_works()
    {
        // Create a test user
        $user = User::factory()->create([
            'name' => 'testuser',
            'password' => Hash::make('password123'),
        ]);

        // Send a login request with 'remember me' checked
        $response = $this->post(route('login'), [
            'name' => 'testuser',
            'password' => 'password123',
            'remember' => 'on',
        ]);

        // Assert user is authenticated
        $this->assertAuthenticatedAs($user);

        // Assert that the session contains a remember token
        $this->assertNotNull($user->fresh()->remember_token);
    }
}
