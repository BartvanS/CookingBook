<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Recipe;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

final class FixImages extends Command
{
    protected $signature = 'image:fix';

    protected $description = 'Fix image paths';

    public function handle(): void
    {
        Recipe::each(function (Recipe $recipe): void {
            $recipe = $this->fixImagePath($recipe);
            $recipe = $this->fixThumbnailPath($recipe);
            $recipe = $this->fixMissingImages($recipe);
            $recipe->save();
        });
    }

    public function fixMissingImages(Recipe $recipe): Recipe
    {
        if ($recipe->image && ! Storage::disk('recipes')->exists($recipe->image)) {
            $recipe->image = null;
        }

        if ($recipe->thumbnail && ! Storage::disk('recipes')->exists($recipe->thumbnail)) {
            $recipe->thumbnail = null;
        }

        return $recipe;
    }

    public function fixImagePath(Recipe $recipe): Recipe
    {
        if (str_starts_with($recipe->image ?? '', 'public/')) {
            $recipe->image = str_replace('public/', '', $recipe->image);
        }

        return $recipe;
    }

    public function fixThumbnailPath(Recipe $recipe): Recipe
    {
        if (str_starts_with($recipe->thumbnail ?? '', 'public/')) {
            $recipe->thumbnail = str_replace('public/', '', $recipe->thumbnail);
        }

        return $recipe;
    }
}
