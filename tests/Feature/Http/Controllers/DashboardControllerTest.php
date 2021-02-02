<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCanViewDashboard()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('dashboard'));

        $response->assertRedirect(route('recipes.index'));
    }
}
