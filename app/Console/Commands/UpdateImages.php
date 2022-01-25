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
            if (Storage::exists($recipe->image)) {
                $path = Storage::path($recipe->image);
                $image = basename($path);
                Storage::disk('recipes')->put(basename($path), Storage::get($recipe->image));

                $recipe->update([
                    'image' => $image,
                ]);

                $this->info(sprintf('Updated recipe #%s image', $recipe->id));
            }

            if (Storage::exists($recipe->thumbnail)) {
                $path = Storage::path($recipe->thumbnail);
                $thumbnail = basename($path);
                Storage::disk('recipes')->put(basename($path), Storage::get($recipe->thumbnail));

                $recipe->update([
                    'thumbnail' => $thumbnail,
                ]);

                $this->info(sprintf('Updated recipe #%s thumbnail', $recipe->id));
            }
        }

        return 0;
    }
}
