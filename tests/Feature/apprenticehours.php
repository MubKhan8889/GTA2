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

        // Check Table Headers
        $response->assertSee('Month');
        $response->assertSee('Date');
        $response->assertSee('Expected Hours');
        $response->assertSee('Training Center Hours');
        $response->assertSee('Employer Training Records');
        $response->assertSee('GTA Specialist Training');
        $response->assertSee('VLE Training');
        $response->assertSee('Total Hours');
        $response->assertSee('Cumulative Hours');

        // Check Table Data
        $response->assertSee('1');
        $response->assertSee('10/20');
        $response->assertSee('16.2');
        $response->assertSee('32.5');
        $response->assertSee('19.5');
        $response->assertSee('6.5');
        $response->assertSee('58.5');

        $response->assertSee('2');
        $response->assertSee('11/20');
        $response->assertSee('56.2');
        $response->assertSee('13');
        $response->assertSee('8.5');
        $response->assertSee('21.5');
        $response->assertSee('80');
    }
}
