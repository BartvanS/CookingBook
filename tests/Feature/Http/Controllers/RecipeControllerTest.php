<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function testCanViewIndex()
    {
        $response = $this->get(route('recipes.index'));

        $response->assertOk();
    }

    public function testCanViewCreate()
    {
        $response = $this->get(route('recipes.create'));

        $response->assertOk();
    }

    public function testCanStoreRecipe()
    {
        $response = $this->post(route('recipes.store'), [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'ingredients' => "Kaas\nBroodje",
            'duration' => '00:30',
        ]);

        $response->assertRedirect();

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('recipes', [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'ingredients' => "Kaas\nBroodje",
            'duration' => 30,
        ]);
    }

    public function testCanViewDetail()
    {
        $recipe = Recipe::factory()->create();

        $response = $this->get(route('recipes.show', $recipe));

        $response->assertOk();
        $response->assertSee($recipe->title);
    }

    public function testCanEditOwnRecipe()
    {
        $recipe = Recipe::factory()->create();
        $recipe->user()->associate($this->user);
        $recipe->save();

        $response = $this->get(route('recipes.edit', $recipe));

        $response->assertOk();
    }

    public function testCannotEditOtherRecipe()
    {
        $recipe = Recipe::factory()->create();

        $response = $this->get(route('recipes.edit', $recipe));

        $response->assertForbidden();
    }

    public function testCanUpdateRecipe()
    {
        $recipe = Recipe::factory()->create();
        $recipe->user()->associate($this->user);
        $recipe->save();

        $response = $this->put(route('recipes.update', $recipe), [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'ingredients' => "Kaas\nBroodje",
            'duration' => '00:30',
        ]);

        $response->assertRedirect();

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('recipes', [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'ingredients' => "Kaas\nBroodje",
            'duration' => 30,
        ]);
    }

    public function testCanDestroyRecipe()
    {
        $recipe = Recipe::factory()->create();
        $recipe->user()->associate($this->user);
        $recipe->save();

        $response = $this->delete(route('recipes.destroy', $recipe));

        $response->assertRedirect();

        $this->assertSoftDeleted($recipe);
    }
}
