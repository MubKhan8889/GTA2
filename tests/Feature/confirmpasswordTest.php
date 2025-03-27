<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class confirmpasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function password_confirmation_page_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('password.confirm'));

        $response->assertStatus(200);
        $response->assertSee('Confirm');
    }

    /** @test */
    public function user_can_confirm_password_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->actingAs($user)->post(route('password.confirm'), [
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_cannot_confirm_password_with_invalid_credentials(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->actingAs($user)->post(route('password.confirm'), [
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('password');
    }
}
