<?php

// tests/Feature/RegisterTest.php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the registration form submission.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        // Arrange: Set up data for the registration form
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'apprentice', // The default value in your form
        ];

        // Act: Submit the registration form (POST request to the register route)
        $response = $this->post(route('register'), $data);

        // Assert: Check if the user is created in the database
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        // Assert: Check if the user is redirected to the intended page after successful registration
        $response->assertRedirect('/home'); // Assuming it redirects to /home after successful registration
    }

    /**
     * Test registration validation for empty name.
     *
     * @return void
     */
    public function test_registration_validation_fails_for_empty_name()
    {
        $data = [
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'apprentice',
        ];

        // Act: Submit the form with missing name
        $response = $this->post(route('register'), $data);

        // Assert: Check if the validation error for the 'name' field is present
        $response->assertSessionHasErrors('name');
    }

    /**
     * Test registration validation for mismatched passwords.
     *
     * @return void
     */
    public function test_registration_validation_fails_for_mismatched_passwords()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password321', // Password mismatch
            'role' => 'apprentice',
        ];

        // Act: Submit the form with mismatched passwords
        $response = $this->post(route('register'), $data);

        // Assert: Check if the validation error for 'password' confirmation is present
        $response->assertSessionHasErrors('password');
    }

    /**
     * Test registration validation for invalid email format.
     *
     * @return void
     */
    public function test_registration_validation_fails_for_invalid_email()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'invalid-email', // Invalid email
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'apprentice',
        ];

        // Act: Submit the form with invalid email
        $response = $this->post(route('register'), $data);

        // Assert: Check if the validation error for the 'email' field is present
        $response->assertSessionHasErrors('email');
    }
}
