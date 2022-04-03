<?php

declare(strict_types=1);

use App\Filament\Resources\TagResource;
use App\Models\Tag;
use App\Models\User;

beforeEach(function (): void {
    $this->actingAs(User::factory()->admin()->create());
});

it('can render index', function (): void {
    $this->get(TagResource::getUrl('index'))->assertSuccessful();
});

it('can render create', function (): void {
    $this->get(TagResource::getUrl('create'))->assertSuccessful();
});

it('can create', function (): void {
    $tag = Tag::factory()->make();

    Livewire::test(TagResource\Pages\CreateTag::class)
        ->set('data.name', $tag->name)
        ->set('data.slug', $tag->slug)
        ->call('create')
        ->assertHasNoErrors();

    $this->assertDatabaseCount(Tag::class, 1);
    $this->assertDatabaseHas(Tag::class, [
        'name' => $tag->name,
        'slug' => $tag->slug,
    ]);
});

it('can validate create', function (): void {
    Livewire::test(TagResource\Pages\CreateTag::class)
        ->set('data.name', null)
        ->call('create')
        ->assertHasErrors(['data.name' => 'required']);
});

it('can render edit', function (): void {
    $tag = Tag::factory()->create();

    $this->get(TagResource::getUrl('edit', ['record' => $tag->id]))->assertSuccessful();
});

it('can update', function (): void {
    $tag = Tag::factory()->create();
    $new = Tag::factory()->make();

    Livewire::test(TagResource\Pages\EditTag::class, ['record' => $tag->id])
        ->set('data.name', $new->name)
        ->set('data.slug', $new->slug)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseCount(Tag::class, 1);
    $this->assertDatabaseHas(Tag::class, [
        'name' => $new->name,
        'slug' => $new->slug,
    ]);
});
