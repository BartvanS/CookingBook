<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\API;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

final class RecipeApiControllerTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user = null;

    protected function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs($this->user = User::factory()->create());
    }

    public function test_index()
    {
        /** @var Recipe $recipe */
        $recipe = Recipe::factory()->create([
            'title' => 'Recipe title',
            'description' => 'Recipe description',
            'duration' => 60,
            'yield' => 2,
            'created_at' => now()->addHour(),
        ]);

        Recipe::factory()->create();

        $response = $this->get(route('api.recipes.index'));

        $response->assertOk();

        $response->assertJson(
            fn (AssertableJson $json) => $json
                ->has('data', 2)
                ->has(
                    'data.0',
                    fn (AssertableJson $json) => $json
                        ->whereAll([
                            'id' => 1,
                            'title' => 'Recipe title',
                            'description' => 'Recipe description',
                            'duration' => 60,
                            'duration_human' => '1 uur',
                            'duration_time' => '01:00',
                            'author' => $recipe->user_id,
                            'yield' => 2,
                            'instructions' => [],
                            'ingredients' => [],
                            'category' => $recipe->category->name,
                            'tags' => [],
                            'image' => null,
                        ])
                        ->has('created_at')
                )
        );
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
        /** @var Recipe $recipe */
        $recipe = Recipe::factory()->create([
            'title' => 'Recipe title',
            'description' => 'Recipe description',
            'duration' => 60,
            'yield' => 2,
            'created_at' => now()->addHour(),
        ]);

        $response = $this->get(route('api.recipes.show', $recipe));

        $response->assertJson(
            fn (AssertableJson $json) => $json
                ->has(
                    'data',
                    fn (AssertableJson $json) => $json->whereAll([
                        'id' => 1,
                        'title' => 'Recipe title',
                        'description' => 'Recipe description',
                        'duration' => 60,
                        'duration_human' => '1 uur',
                        'duration_time' => '01:00',
                        'author' => $recipe->user_id,
                        'yield' => 2,
                        'instructions' => [],
                        'ingredients' => [],
                        'category' => $recipe->category->name,
                        'tags' => [],
                        'image' => null,
                    ])
                        ->has('created_at')
                )
        );
    }

    public function test_create()
    {
        $category = Category::factory()->create();

        $response = $this->post(route('api.recipes.create'), [
            'title' => 'Recipe title',
            'description' => 'Recipe description',
            'category' => $category->id,
            'duration' => '01:00',
            'ingredients' => ['gehakt', 'kaas', 'henk'],
            'instructions' => ['gehakt', 'kaas', 'henk'],
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('recipes', [
            'title' => 'Recipe title',
            'description' => 'Recipe description',
            'category_id' => $category->id,
            'duration' => 60,
        ]);
        $this->assertDatabaseCount('ingredients', 3);
        $this->assertDatabaseCount('instructions', 3);

        $response->assertJson(
            fn (AssertableJson $json) => $json
                ->has(
                    'data',
                    fn (AssertableJson $json) => $json->whereAll([
                        'id' => 1,
                        'title' => 'Recipe title',
                        'description' => 'Recipe description',
                        'duration' => 60,
                        'duration_human' => '1 uur',
                        'duration_time' => '01:00',
                        'author' => $this->user->id,
                        'yield' => null,
                        'instructions' => ['gehakt', 'kaas', 'henk'],
                        'ingredients' => ['gehakt', 'kaas', 'henk'],
                        'category' => $category->name,
                        'tags' => [],
                        'image' => null,
                    ])
                        ->has('created_at')
                )
        );
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
