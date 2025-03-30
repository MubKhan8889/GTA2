<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;  // Ensure the database is refreshed between tests

    /**
     * Test that the login page renders correctly.
     */
    public function test_login_page_renders()
    {
        $response = $this->get(route('login'));  // Assuming your route is named 'login'

        $response->assertStatus(200);  // Check if the page loads successfully
        $response->assertViewIs('auth.login');  // Ensure the correct view is returned
        $response->assertSee('Get Started Now');  // Check if the specific content (like a title) is present
    }

    /**
     * Test that a valid user can log in successfully.
     */
    public function test_valid_user_can_login()
    {
        // Arrange: Create a user
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => bcrypt('password123'),  // Store the password hash
        ]);

        // Act: Send a post request with valid credentials
        $response = $this->post(route('login'), [
            'name' => $user->name,  // Using 'name' as the username input
            'password' => 'password123',
        ]);

        // Assert: Check if the user is authenticated
        $this->assertAuthenticatedAs($user);  // Ensure the user is logged in

        // Assert: Ensure the user is redirected to the dashboard (or any page post-login)
        $response->assertRedirect(route('dashboard'));  // Adjust the route as necessary
    }

    /**
     * Test that an invalid login attempt fails.
     */
    public function test_invalid_user_cannot_login()
    {
        // Act: Try to log in with invalid credentials
        $response = $this->post(route('login'), [
            'name' => 'nonexistentuser',
            'password' => 'wrongpassword',
        ]);

        // Assert: Check that the user is not authenticated
        $this->assertGuest();  // Ensure the user is not logged in

        // Assert: Check that the page contains an error message
        $response->assertSessionHasErrors(['name' => 'These credentials do not match our records.']);
    }

    /**
     * Test unauthenticated user is redirected when accessing a protected route.
     */
    public function test_unauthenticated_user_redirected()
    {
        // Act: Try to access a protected route without being authenticated
        $response = $this->get(route('dashboard'));  // Adjust to a protected route that requires login

        // Assert: Check if the user is redirected to the login page
        $response->assertRedirect(route('login'));
    }
}
