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
    public function it_displays_the_apprentice_dashboard_correctly()
    {
        // Arrange: Create a user and authenticate
        $user = User::factory()->create(['name' => 'Apprentice User']);

        $this->actingAs($user);

        // Act: Visit the apprentice dashboard
        $response = $this->get('/dashboard');

        // Assert: Ensure the dashboard loads correctly
        $response->assertStatus(200);
        $response->assertSee('Dashboard for Apprentice');
        $response->assertSee('Welcome, Apprentice User');

        // Check RAG indicators
        $response->assertSee('Overall RAG');
        $response->assertSee('Progress RAG');
        $response->assertSee('OTJ RAG');
        $response->assertSee('Employment RAG');

        // Check In Progress Duties
        $response->assertSee('In Progress Duties');
        $response->assertSee('Group 1: Foundation Skills');

        // Check Overdue Duties
        $response->assertSee('Overdue Duties');
        $response->assertSee('Group 5: Steering and Suspension');

        // Check Monthly Hours
        $response->assertSee('Your hours this month');
        $response->assertSee('Total hours: 23.5');

        // Check Total Hours
        $response->assertSee('Your hours in total');
        $response->assertSee('Total hours: 176.8');
        $response->assertSee('Expected Hours: 150');
    }
}
