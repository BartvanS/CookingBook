<?php

declare(strict_types=1);

use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use App\Models\User;

beforeEach(function (): void {
    $this->actingAs(User::factory()->admin()->create());
});

it('can render index', function (): void {
    $this->get(CategoryResource::getUrl('index'))->assertSuccessful();
});

it('can render create', function (): void {
    $this->get(CategoryResource::getUrl('create'))->assertSuccessful();
});

it('can create', function (): void {
    $category = Category::factory()->make();

    Livewire::test(CategoryResource\Pages\CreateCategory::class)
        ->set('data.name', $category->name)
        ->call('create')
        ->assertHasNoErrors();

    $this->assertDatabaseCount(Category::class, 1);
    $this->assertDatabaseHas(Category::class, [
        'name' => $category->name,
    ]);
});

it('can validate create', function (): void {
    Livewire::test(CategoryResource\Pages\CreateCategory::class)
        ->set('data.name', null)
        ->call('create')
        ->assertHasErrors(['data.name' => 'required']);
});

it('can render edit', function (): void {
    $category = Category::factory()->create();

    $this->get(CategoryResource::getUrl('edit', ['record' => $category->id]))->assertSuccessful();
});

it('can update', function (): void {
    $category = Category::factory()->create();
    $new = Category::factory()->make();

    Livewire::test(CategoryResource\Pages\EditCategory::class, ['record' => $category->id])
        ->set('data.name', $new->name)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseCount(Category::class, 1);
    $this->assertDatabaseHas(Category::class, [
        'name' => $new->name,
    ]);
});
