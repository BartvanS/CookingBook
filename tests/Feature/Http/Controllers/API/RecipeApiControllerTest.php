<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\API;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

final class RecipeApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_no_parameter()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );
        Recipe::factory()->count(10)->create();
        $response = $this->get('/api/recipes');
        $response->assertStatus(200);
        $response->assertJsonCount(10);
    }

//    public function test_index_custom_amount()
//    {
//        Sanctum::actingAs(
//            User::factory()->create()
//        );
//        Recipe::factory()->count(50)->create();
//        $response = $this->get('/api/recipes', ['amount' => 50]);
//        $response->assertStatus(200);
//        $response->assertJsonCount(50);
//    }
//    public function test_insert(){
//        Sanctum::actingAs(
//            User::factory()->create()
//        );
//        $response = $this->post('/api/recipes', [
//            'title' => 'apitest',
//            'description' => 'heel veel kaas \n',
//            'category' => 'Hoofdgerecht',
//            'duration' => '300',
//            'ingredients' => '["gehakt", "kaas", "henk"]',
//            'instructions' => '["gehakt", "kaas", "henk"]',
//        ]);
//        $response->assertStatus(200);
//        $this->assertDatabaseHas('recipes', [
//            'title' => 'apitest',
//            'description' => 'heel veel kaas \n',
//            'category' => 'Hoofdgerecht',
//            'duration' => '300',
//        ]);
//        $this->assertDatabaseCount('ingredients', 3);
//        $this->assertDatabaseCount('instructions', 3);
//$this->assertSeeText('success');
//    }
}
