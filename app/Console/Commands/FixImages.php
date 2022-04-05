<?php

namespace App\Console\Commands;

use App\Models\Recipe;
use Illuminate\Console\Command;

class FixImages extends Command
{
    protected $signature = 'image:fix';

    protected $description = 'Fix image paths';

    public function handle()
    {
        Recipe::each(function (Recipe $recipe) {
            if (! str_starts_with( $recipe->image ?? '', 'public/')) {
                return;
            }

            $recipe->image = str_replace('public/', '', $recipe->image);
            $recipe->save();
        });

        Recipe::each(function (Recipe $recipe) {
            if (! str_starts_with( $recipe->thumbnail ?? '', 'public/')) {
                return;
            }

            $recipe->thumbnail = str_replace('public/', '', $recipe->thumbnail);
            $recipe->save();
        });
    }
}
