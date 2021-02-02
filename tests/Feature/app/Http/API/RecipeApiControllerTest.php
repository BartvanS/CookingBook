<?php

declare(strict_types=1);

namespace Tests\Feature\app\Http\API;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

final class RecipeApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );
        Recipe::factory()->count(10)->create();
        $response = $this->get('/api/recipes');
        $response->assertStatus(200);
        $response->assertJsonCount(10);
    }
}
