<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_admin_dashboard_correctly()
    {
        // Arrange: Create a user and authenticate
        $user = User::factory()->create(['name' => 'Admin User']);

        $this->actingAs($user);

        // Act: Visit the admin dashboard
        $response = $this->get('/dashboard');

        // Assert: Ensure the dashboard loads correctly
        $response->assertStatus(200);
        $response->assertSee('Dashboard for Admin');
        $response->assertSee('Welcome, Admin User');

        // Check RAG indicators
        $response->assertSee('Overall Learner RAG');
        $response->assertSee('Progress RAG');
        $response->assertSee('OTJ RAG');
        $response->assertSee('Employment RAG');

        // Check In Progress Duties
        $response->assertSee('Overall in Progress Duties');
        $response->assertSee('Group 1: Foundation Skills');

        // Check Overdue Duties
        $response->assertSee('Overall Overdue Duties');
        $response->assertSee('Group 5: Steering and Suspension');

        // Check Hours
        $response->assertSee('Overall Hours');
        $response->assertSee('Total hours: 176.8');
        $response->assertSee('Expected Hours: 150');
    }
}
