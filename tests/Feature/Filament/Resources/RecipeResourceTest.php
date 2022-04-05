<?php

declare(strict_types=1);

use App\Filament\Resources\RecipeResource;
use App\Models\Comment;
use App\Models\Ingredient;
use App\Models\Instruction;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;

beforeEach(function (): void {
    $this->actingAs(User::factory()->admin()->create());
});

it('can render index', function (): void {
    $this->get(RecipeResource::getUrl('index'))->assertSuccessful();
});

it('can filter with tags', function (): void {
    $tag = Tag::factory()->create();
    $recipe = Recipe::factory()->create();
    $recipe->tags()->attach($tag);

    Livewire::test(RecipeResource\Pages\ListRecipes::class)
        ->set('tableFilters.tag.value', $tag->id);
});

it('can render create', function (): void {
    $this->get(RecipeResource::getUrl('create'))->assertSuccessful();
});

it('can create', function (): void {
    $recipe = Recipe::factory()->make();

    Livewire::test(RecipeResource\Pages\CreateRecipe::class)
        ->set('data.title', $recipe->title)
        ->set('data.description', $recipe->description)
        ->set('data.duration', $recipe->duration)
        ->set('data.yield', $recipe->yield)
        ->set('data.category_id', $recipe->category_id)
        ->set('data.user_id', $recipe->user_id)
        ->call('create')
        ->assertHasNoErrors();

    $this->assertDatabaseCount(Recipe::class, 1);
    $this->assertDatabaseHas(Recipe::class, [
        'title' => $recipe->title,
        'description' => $recipe->description,
        'duration' => $recipe->duration,
        'yield' => $recipe->yield,
        'category_id' => $recipe->category_id,
        'user_id' => $recipe->user_id,
    ]);
});

it('can validate create', function (): void {
    Livewire::test(RecipeResource\Pages\CreateRecipe::class)
        ->set('data.title', null)
        ->call('create')
        ->assertHasErrors(['data.title' => 'required']);
});

it('can render edit', function (): void {
    $recipe = Recipe::factory()->create();

    $this->get(RecipeResource::getUrl('edit', ['record' => $recipe->id]))->assertSuccessful();
});

it('can render relationships', function (): void {
    $recipe = Recipe::factory()
        ->has(Comment::factory()->count(3))
        ->has(Ingredient::factory()->count(3))
        ->has(Instruction::factory()->count(3))
        ->create();

    Livewire::test(RecipeResource\Pages\EditRecipe::class, ['record' => $recipe->id])
        ->set('activeRelationManager', 0)
        ->set('activeRelationManager', 1)
        ->set('activeRelationManager', 2);
});

it('can update', function (): void {
    $recipe = Recipe::factory()->create();
    $new = Recipe::factory()->make();

    Livewire::test(RecipeResource\Pages\EditRecipe::class, ['record' => $recipe->id])
        ->set('data.title', $new->title)
        ->set('data.description', $new->description)
        ->set('data.duration', $new->duration)
        ->set('data.yield', $new->yield)
        ->set('data.category_id', $new->category_id)
        ->set('data.user_id', $new->user_id)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseCount(Recipe::class, 1);
    $this->assertDatabaseHas(Recipe::class, [
        'title' => $new->title,
        'description' => $new->description,
        'duration' => $new->duration,
        'yield' => $new->yield,
        'category_id' => $new->category_id,
        'user_id' => $new->user_id,
    ]);
});
