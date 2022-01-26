<?php

declare(strict_types=1);

use App\Http\Livewire\Tables\RecipesTable;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;

it('can see recipes', function () {
    Recipe::factory()->create([
        'title' => 'Lasagne',
    ]);

    Livewire::test(RecipesTable::class)
        ->assertSeeText('Lasagne')
        ->set('search', '');
});

it('can search recipes', function () {
    Recipe::factory()->create([
        'title' => 'Lasagne',
    ]);

    Livewire::test(RecipesTable::class)
        ->assertSeeText('Lasagne')
        ->set('search', 'test')
        ->assertDontSeeText('Lasagne')
        ->set('search', 'lasagne')
        ->assertSeeText('Lasagne');
});

it('can see recipes with category', function () {
    $category = Category::factory()->create();
    Recipe::factory()->create([
        'title' => 'Lasagne',
    ]);

    Livewire::test(RecipesTable::class)
        ->assertSeeText('Lasagne')
        ->set('category', strval($category->id))
        ->assertDontSeeText('Lasagne');
});

it('can see recipes with tag', function () {
    Recipe::factory()->create([
        'title' => 'Lasagne',
    ]);
    $tag = Tag::factory()->create([
        'name' => 'Wow',
    ]);

    Livewire::test(RecipesTable::class)
        ->assertSeeText('Lasagne')
        ->set('tag', $tag->slug)
        ->assertDontSeeText('Lasagne');
});
