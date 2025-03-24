<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Test;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_displays_the_dashboard_correctly()
    {
        // Arrange: Create a user and authenticate
        $user = User::factory()->create(['name' => 'Test User']);

        $this->actingAs($user);

        // Act: Visit the dashboard
        $response = $this->get('/dashboard');

        // Assert: Ensure the dashboard loads correctly
        $response->assertStatus(200);
        $response->assertSee("You're logged in!");

        // Verify dashboard header and user greeting
        $response->assertSee('Dashboard');
    }
}
