<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the user can register successfully.
     *
     * @return void
     */
    public function test_user_can_register_successfully()
    {
        // Send POST request to the register route
        $response = $this->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'apprentice', // Assuming role is being passed
        ]);

        // Assert that the user is created and redirected to the intended route
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'role' => 'apprentice',
        ]);

        $response->assertRedirect(route('home')); // You can change this based on the actual redirect route
        $this->assertAuthenticatedAs(User::first()); // Ensure that the user is authenticated
    }

    /**
     * Test that the user cannot register with invalid data.
     *
     * @return void
     */
    public function test_user_cannot_register_with_invalid_data()
    {
        // Send POST request with invalid data
        $response = $this->post(route('register'), [
            'name' => '', // Name is empty
            'email' => 'invalid-email', // Invalid email
            'password' => 'password123',
            'password_confirmation' => 'wrongpassword', // Passwords do not match
            'role' => 'apprentice',
        ]);

        // Assert that the validation errors occur
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /**
     * Test that a user cannot register with an existing email.
     *
     * @return void
     */
    public function test_user_cannot_register_with_existing_email()
    {
        // Create an existing user
        User::factory()->create([
            'email' => 'john@example.com',
        ]);

        // Send POST request with the same email
        $response = $this->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'apprentice',
        ]);

        // Assert that the registration fails
        $response->assertSessionHasErrors(['email']);
    }
}
