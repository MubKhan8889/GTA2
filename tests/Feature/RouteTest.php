<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Session;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_confirm_password_successfully()
    {
        // Create a test user with a known password
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        // Act as the user
        $this->actingAs($user);

        // Start a session (required for CSRF token)
        Session::start();

        // Send a POST request to confirm password
        $response = $this->post(route('password.confirm'), [
            '_token' => csrf_token(),
            'password' => 'password123',
        ]);

        // Assert that the confirmation was successful (redirect or correct response)
        $response->assertRedirect(); // Ensure redirection happens
        $response->assertSessionHasNoErrors(); // No validation errors
    }

    #[Test]
    public function user_can_request_password_reset()
    {
        // Prevent actual notifications from being sent
        Notification::fake();

        // Create a test user
        $user = User::factory()->create();

        // Send a POST request to request a password reset
        $response = $this->post(route('password.email'), [
            'email' => $user->email,
        ]);

        // Assert the response redirects correctly
        $response->assertRedirect();
        $response->assertSessionHas('status');

        // Ensure the correct notification was sent
        Notification::assertSentTo($user, \Illuminate\Auth\Notifications\ResetPassword::class);
    }
}
