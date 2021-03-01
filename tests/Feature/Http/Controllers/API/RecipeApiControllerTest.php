<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\API;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

final class RecipeApiControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs(User::factory()->create());
    }

    public function test_index()
    {
        Recipe::factory()->count(10)->create();

        $response = $this->get(route('api.recipes.index'));

        $response->assertOk();
        $response->assertJsonCount(10, 'data');
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'description',
                    'author',
                    'duration',
                    'duration_human',
                    'duration_time',
                    'yield',
                    'image',
                    'instructions',
                    'ingredients',
                    'created_at',
                ],
            ],
        ]);
    }

    public function test_index_limit()
    {
        Recipe::factory()->count(5)->create();

        $response = $this->get(route('api.recipes.index', ['limit' => 2]));

        $response->assertOk();
        $response->assertJsonCount(2, 'data');
    }

    public function test_index_search()
    {
        Recipe::factory()->create([
            'title' => 'kaas',
        ]);

        $response = $this->get(route('api.recipes.index', ['search' => 'kaas']));

        $response->assertOk();
        $response->assertJsonCount(1, 'data');

        $response = $this->get(route('api.recipes.index', ['search' => 'chocoladekaas']));

        $response->assertOk();
        $response->assertJsonCount(0, 'data');
    }

    public function test_show()
    {
        $recipe = Recipe::factory()->create();

        $response = $this->get(route('api.recipes.show', $recipe));

        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'description',
                'author',
                'duration',
                'duration_human',
                'duration_time',
                'yield',
                'image',
                'instructions',
                'ingredients',
                'created_at',
            ],
        ]);
    }

    public function test_create()
    {
        $category = Category::factory()->create();

        $response = $this->post(route('api.recipes.create'), [
            'title' => 'apitest',
            'description' => 'heel veel kaas',
            'category' => $category->id,
            'duration' => '00:30',
            'ingredients' => ['gehakt', 'kaas', 'henk'],
            'instructions' => ['gehakt', 'kaas', 'henk'],
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('recipes', [
            'title' => 'apitest',
            'description' => 'heel veel kaas',
            'category_id' => $category->id,
            'duration' => 30,
        ]);
        $this->assertDatabaseCount('ingredients', 3);
        $this->assertDatabaseCount('instructions', 3);
    }

    public function test_cannot_create_with_long_ingredient()
    {
        $category = Category::factory()->create();

        $response = $this->post(route('api.recipes.create'), [
            'title' => 'apitest',
            'description' => 'heel veel kaas',
            'category' => $category->id,
            'duration' => '00:30',
            'ingredients' => [str_repeat('a', 260), 'kaas', 'henk'],
            'instructions' => ['gehakt', 'kaas', 'henk'],
        ]);

        $response->assertRedirect();

        $response->assertSessionHasErrors('ingredients');

        $this->assertDatabaseCount('recipes', 0);
        $this->assertDatabaseCount('ingredients', 0);
    }
}
