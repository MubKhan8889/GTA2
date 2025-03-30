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
        $response->assertSee('Your progress');
        $response->assertSee('Welcome, Apprentice User');

        // Check Apprentice Info
        $response->assertSee('Apprenticeship Start Date: 11/10/2020');
        $response->assertSee('OTJ Target Overall: 1252.1');
        $response->assertSee('No. of Months: 36');

        // Check Duties RAG
        $response->assertSee('Duties RAG');
        $response->assertSee('Completed');
        $response->assertSee('In progress');
        $response->assertSee('Overdue');

        // Check Duties Information - Year 1
        $response->assertSee('Year 1');
        $response->assertSee('Group 1: Foundation Skills');
        $response->assertSee('08/12/22');
        $response->assertSee('01/01/23');

        $response->assertSee('Group 1: Other Skills');
        $response->assertSee('Not due');
        $response->assertSee('Starting and Changing Systems');
        $response->assertSee('Overdue');

        // Check Duties Information - Year 2
        $response->assertSee('Year 2');
        $response->assertSee('Group 2: Other Skills');
        $response->assertSee('18/6/23');
        $response->assertSee('01/01/24');

        $response->assertSee('Starting and Changing Systems');
        $response->assertSee('Overdue');
    }
}
