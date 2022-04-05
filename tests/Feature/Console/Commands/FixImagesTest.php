<?php

use App\Console\Commands\FixImages;
use App\Models\Recipe;
use function Pest\Laravel\artisan;

test('does not change fixed images', function () {
    $recipe = Recipe::factory()->create([
        'image' => 'image/image.jpg',
        'thumbnail' => 'image/image.jpg',
    ]);

    artisan(FixImages::class)
        ->assertSuccessful();

    $recipe->refresh();

    expect($recipe->image)->toBe('image/image.jpg');
    expect($recipe->thumbnail)->toBe('image/image.jpg');
});


test('fixed images with public prefix', function () {
    $recipe = Recipe::factory()->create([
        'image' => 'public/image/image.jpg',
        'thumbnail' => 'public/image/image.jpg',
    ]);

    artisan(FixImages::class)
        ->assertSuccessful();

    $recipe->refresh();

    expect($recipe->image)->toBe('image/image.jpg');
    expect($recipe->thumbnail)->toBe('image/image.jpg');
});
