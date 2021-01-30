<?php

namespace Tests\Feature\app\Http\API;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RecipeApiControllerTest extends TestCase
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
