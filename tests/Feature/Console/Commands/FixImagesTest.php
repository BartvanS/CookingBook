<?php

declare(strict_types=1);

use App\Console\Commands\FixImages;
use App\Models\Recipe;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\artisan;

beforeEach(function (): void {
    Storage::fake('recipes');
    Storage::disk('recipes')->put('image/image.jpg', 'image');
    Storage::disk('recipes')->put('image.jpg', 'image');
});

it('does not fix fixed images', function (): void {
    $recipe = Recipe::factory()->create([
        'image' => 'image/image.jpg',
        'thumbnail' => 'image.jpg',
    ]);

    artisan(FixImages::class)
        ->assertSuccessful();

    $recipe->refresh();

    expect($recipe->image)->toBe('image/image.jpg');
    expect($recipe->thumbnail)->toBe('image.jpg');
});

it('does not change null images', function (): void {
    $recipe = Recipe::factory()->create([
        'image' => null,
        'thumbnail' => null,
    ]);

    artisan(FixImages::class)
        ->assertSuccessful();

    $recipe->refresh();

    expect($recipe->image)->toBeNull();
    expect($recipe->thumbnail)->toBeNull();
});

it('fixed images with public prefix', function (): void {
    $recipe = Recipe::factory()->create([
        'image' => 'public/image/image.jpg',
        'thumbnail' => 'public/image.jpg',
    ]);

    artisan(FixImages::class)
        ->assertSuccessful();

    $recipe->refresh();

    expect($recipe->image)->toBe('image/image.jpg');
    expect($recipe->thumbnail)->toBe('image.jpg');
});

it('fixed missing images', function (): void {
    $recipe = Recipe::factory()->create([
        'image' => 'missing/image.jpg',
        'thumbnail' => 'missing/image.jpg',
    ]);

    artisan(FixImages::class)
        ->assertSuccessful();

    $recipe->refresh();

    expect($recipe->image)->toBeNull();
    expect($recipe->thumbnail)->toBeNull();
});
