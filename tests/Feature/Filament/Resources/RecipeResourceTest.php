<?php

declare(strict_types=1);

use App\Filament\Resources\RecipeResource;
use App\Models\Recipe;
use App\Models\User;

beforeEach(function (): void {
    $this->actingAs(User::factory()->admin()->create());
});

it('can render index', function (): void {
    $this->get(RecipeResource::getUrl('index'))->assertSuccessful();
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
        ->call('create');

    $this->assertDatabaseHas(Recipe::class, [
        'title' => $recipe->title,
        'description' => $recipe->description,
        'duration' => $recipe->duration,
        'yield' => $recipe->yield,
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

it('can update', function (): void {
    $recipe = Recipe::factory()->create();

    Livewire::test(RecipeResource\Pages\CreateRecipe::class, ['record' => $recipe->id])
        ->set('data.title', $recipe->title)
        ->set('data.description', $recipe->description)
        ->set('data.duration', $recipe->duration)
        ->set('data.yield', $recipe->yield)
        ->call('save');

    $this->assertDatabaseHas(Recipe::class, [
        'title' => $recipe->title,
        'description' => $recipe->description,
        'duration' => $recipe->duration,
        'yield' => $recipe->yield,
    ]);
});
