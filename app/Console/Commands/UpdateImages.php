<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Recipe;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

final class UpdateImages extends Command
{
    protected $signature = 'image:update';

    public function handle(): int
    {
        $recipes = Recipe::all();

        foreach ($recipes as $recipe) {
            $path = Storage::path($recipe->image);

            if (Storage::exists($path)) {
                $image = basename($path);
                $newPath = Storage::disk('recipes')->path(basename($path));

                Storage::copy($path, $newPath);

                $recipe->update([
                    'image' => $image,
                ]);

                $this->info(sprintf('Updated recipe #%s image', $recipe->id));
            }

            $path = Storage::path($recipe->thumbnail);

            if (Storage::exists($path)) {
                $image = basename($path);
                $newPath = Storage::disk('recipes')->path(basename($path));

                Storage::copy($path, $newPath);

                $recipe->update([
                    'thumbnail' => $image,
                ]);

                $this->info(sprintf('Updated recipe #%s thumbnail', $recipe->id));
            }
        }

        return 0;
    }
}
