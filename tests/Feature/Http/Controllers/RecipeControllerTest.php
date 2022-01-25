<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

final class RecipeControllerTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function testCanViewIndex(): void
    {
        $response = $this->get(route('recipes.index'));

        $response->assertOk();
    }

    public function testCanViewCreate(): void
    {
        $response = $this->get(route('recipes.create'));

        $response->assertOk();
    }

    public function testCanStoreRecipe(): void
    {
        Storage::fake();

        $file = UploadedFile::fake()->image('image.jpg');

        $category = Category::factory()->create();

        $response = $this->post(route('recipes.store'), [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'category' => $category->id,
            'ingredients' => "Kaas\nBroodje",
            'instructions' => "Bakken\nBraden",
            'duration' => '00:30',
            'image' => $file,
        ]);

        $response->assertRedirect();

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('recipes', [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'duration' => 30,
            'category_id' => $category->id,
        ]);
        $this->assertDatabaseCount('ingredients', 2);
        $this->assertDatabaseCount('instructions', 2);

        Storage::assertExists($file->hashName('public'));
    }

    public function testCanStoreRecipeWithTags(): void
    {
        $category = Category::factory()->create();
        $tag = Tag::factory()->create([
            'name' => 'Wow',
            'slug' => 'wow',
        ]);

        $response = $this->post(route('recipes.store'), [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'category' => $category->id,
            'ingredients' => 'Kaas',
            'instructions' => 'Bakken',
            'tags' => "Wow\nKaas",
            'duration' => '00:30',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseCount('tags', 2);
        $this->assertDatabaseHas('tags', [
            'name' => 'Kaas',
            'slug' => 'kaas',
        ]);

        $this->assertTrue(Recipe::first()->tags->contains($tag));
    }

    public function testCannotStoreRecipeWithLongTagName(): void
    {
        $category = Category::factory()->create();

        $response = $this->post(route('recipes.store'), [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'category' => $category->id,
            'ingredients' => 'Kaas',
            'instructions' => 'Bakken',
            'tags' => str_repeat('a', 260) . "\nTest",
            'duration' => '00:30',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('tags');

        $this->assertDatabaseCount('recipes', 0);
        $this->assertDatabaseCount('tags', 0);
    }

    public function testCannotStoreRecipeWithTooManyTags(): void
    {
        $category = Category::factory()->create();

        $response = $this->post(route('recipes.store'), [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'category' => $category->id,
            'ingredients' => 'Kaas',
            'instructions' => 'Bakken',
            'tags' => "Cool\nGezond\nHip\nEten\nSnack\nGezellig\nKerst",
            'duration' => '00:30',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('tags');

        $this->assertDatabaseCount('recipes', 0);
        $this->assertDatabaseCount('tags', 0);
    }

    public function testCannotStoreWithLongIngredients(): void
    {
        $category = Category::factory()->create();

        $response = $this->post(route('recipes.store'), [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'category' => $category->id,
            'ingredients' => str_repeat('a', 260) . PHP_EOL . str_repeat('b', 50),
            'instructions' => "Bakken\nBraden",
            'duration' => '00:30',
        ]);

        $response->assertRedirect();

        $response->assertSessionHasErrors('ingredients');

        $this->assertDatabaseCount('recipes', 0);
        $this->assertDatabaseCount('ingredients', 0);
    }

    public function testCanViewDetail(): void
    {
        $recipe = Recipe::factory()->create();

        $response = $this->get(route('recipes.show', $recipe));

        $response->assertOk();
        $response->assertSee($recipe->title);
    }

    public function testCanEditOwnRecipe(): void
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

    public function testCannotEditOtherRecipe(): void
    {
        $recipe = Recipe::factory()->create([
            'user_id' => User::factory(),
        ]);

        $response = $this->get(route('recipes.edit', $recipe));

        $response->assertForbidden();
    }

    public function testCanUpdateRecipe(): void
    {
        $category = Category::factory()->create();

        $recipe = Recipe::factory()->create();
        $recipe->user()->associate($this->user);
        $recipe->save();
        Ingredient::factory()->count(1)->create([
            'recipe_id' => $recipe,
        ]);

        $response = $this->put(route('recipes.update', $recipe), [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'category' => $category->id,
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
            'category_id' => $category->id,
        ]);
        $this->assertDatabaseCount('ingredients', 2);
        $this->assertDatabaseCount('instructions', 2);
    }

    public function testCanUpdateRecipeWithTags(): void
    {
        /** @var Recipe $recipe */
        $recipe = Recipe::factory()->create([
            'user_id' => $this->user,
        ]);
        $category = Category::factory()->create();
        $tag = Tag::factory()->create([
            'name' => 'Wow',
            'slug' => 'wow',
        ]);
        $recipe->tags()->attach($tag);

        $response = $this->put(route('recipes.update', $recipe), [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'category' => $category->id,
            'ingredients' => 'Kaas',
            'instructions' => 'Bakken',
            'tags' => "Wow\nKaas",
            'duration' => '00:30',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseCount('tags', 2);
        $this->assertDatabaseHas('tags', [
            'name' => 'Kaas',
            'slug' => 'kaas',
        ]);

        $this->assertTrue(Recipe::first()->tags->contains($tag));
    }

    public function testCanUpdateToLessIngredients(): void
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
            'category' => Category::factory()->create()->id,
            'ingredients' => 'Kaas',
            'instructions' => 'Bakken',
            'duration' => '00:30',
        ]);

        $response->assertRedirect();

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseCount('ingredients', 1);
        $this->assertDatabaseCount('instructions', 1);
    }

    public function testCannotUpdateWithLongIngredients(): void
    {
        $recipe = Recipe::factory()->create();
        $recipe->user()->associate($this->user);
        $recipe->save();

        $response = $this->put(route('recipes.update', $recipe), [
            'title' => 'Kaasbroodje',
            'description' => 'Lekker eten',
            'category' => Category::factory()->create()->id,
            'ingredients' => str_repeat('a', 260) . PHP_EOL . str_repeat('b', 50),
            'instructions' => "Bakken\nBraden",
            'duration' => '00:30',
        ]);

        $response->assertRedirect();

        $response->assertSessionHasErrors('ingredients');

        $this->assertDatabaseCount('ingredients', 0);
    }

    public function testCanDestroyRecipe(): void
    {
        /** @var Recipe $recipe */
        $recipe = Recipe::factory()->create();
        $recipe->user()->associate($this->user);
        $recipe->save();

        $comment = Comment::factory()->create([
            'recipe_id' => $recipe,
        ]);

        Ingredient::factory()->count(3)->create([
            'recipe_id' => $recipe,
        ]);

        $response = $this->delete(route('recipes.destroy', $recipe));

        $response->assertRedirect();

        $this->assertSoftDeleted($recipe);

        $this->assertSoftDeleted($comment);

        $this->assertDatabaseCount('ingredients', 3);
    }
}
