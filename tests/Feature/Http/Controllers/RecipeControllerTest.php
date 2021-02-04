<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class RecipeControllerTest extends TestCase
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
            'instructions' => "Bakken\nBraden",
            'duration' => '00:30',
        ]);

        $response->assertRedirect();

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('recipes', [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'duration' => 30,
        ]);
        $this->assertDatabaseCount('ingredients', 2);
        $this->assertDatabaseCount('instructions', 2);
    }

    public function testCannotStoreWithLongIngredients()
    {
        $response = $this->post(route('recipes.store'), [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'ingredients' => str_repeat('a', 260) . PHP_EOL . str_repeat('b', 50),
            'instructions' => "Bakken\nBraden",
            'duration' => '00:30',
        ]);

        $response->assertRedirect();

        $response->assertSessionHasErrors('ingredients');

        $this->assertDatabaseCount('recipes', 0);
        $this->assertDatabaseCount('ingredients', 0);
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
        Ingredient::factory()->count(3)->create([
            'recipe_id' => $recipe,
        ]);

        $response = $this->get(route('recipes.edit', $recipe));

        $response->assertOk();
    }

    public function testCannotEditOtherRecipe()
    {
        $recipe = Recipe::factory()->create();
        Ingredient::factory()->count(3)->create([
            'recipe_id' => $recipe,
        ]);

        $response = $this->get(route('recipes.edit', $recipe));

        $response->assertForbidden();
    }

    public function testCanUpdateRecipe()
    {
        $recipe = Recipe::factory()->create();
        $recipe->user()->associate($this->user);
        $recipe->save();
        Ingredient::factory()->count(1)->create([
            'recipe_id' => $recipe,
        ]);

        $response = $this->put(route('recipes.update', $recipe), [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'ingredients' => "Kaas\nBroodje",
            'instructions' => "Bakken\nBraden",
            'duration' => '00:30',
        ]);

        $response->assertRedirect();

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('recipes', [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'duration' => 30,
        ]);
        $this->assertDatabaseCount('ingredients', 2);
        $this->assertDatabaseCount('instructions', 2);
    }

    public function testCanUpdateToLessIngredients()
    {
        $recipe = Recipe::factory()->create();
        $recipe->user()->associate($this->user);
        $recipe->save();
        Ingredient::factory()->count(3)->create([
            'recipe_id' => $recipe,
        ]);

        $response = $this->put(route('recipes.update', $recipe), [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'ingredients' => 'Kaas',
            'instructions' => 'Bakken',
            'duration' => '00:30',
        ]);

        $response->assertRedirect();

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseCount('ingredients', 1);
        $this->assertDatabaseCount('instructions', 1);
    }

    public function testCannotUpdateWithLongIngredients()
    {
        $recipe = Recipe::factory()->create();
        $recipe->user()->associate($this->user);
        $recipe->save();

        $response = $this->put(route('recipes.update', $recipe), [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'ingredients' => str_repeat('a', 260) . PHP_EOL . str_repeat('b', 50),
            'instructions' => "Bakken\nBraden",
            'duration' => '00:30',
        ]);

        $response->assertRedirect();

        $response->assertSessionHasErrors('ingredients');

        $this->assertDatabaseCount('ingredients', 0);
    }

    public function testCanDestroyRecipe()
    {
        $recipe = Recipe::factory()->create();
        $recipe->user()->associate($this->user);
        $recipe->save();
        Ingredient::factory()->count(3)->create([
            'recipe_id' => $recipe,
        ]);

        $response = $this->delete(route('recipes.destroy', $recipe));

        $response->assertRedirect();

        $this->assertSoftDeleted($recipe);
        $this->assertDatabaseCount('ingredients', 3);
    }
}
