<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Ingredient;
use App\Models\Instruction;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'a@a',
            'password' => Hash::make('a'),
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        Recipe::factory()
            ->count(50)
            ->create()
            ->each(function (Recipe $recipe) {
                Ingredient::factory()
                    ->count(random_int(1, 5))
                    ->create([
                        'recipe_id' => $recipe,
                    ]);

                Instruction::factory()
                    ->count(random_int(1, 8))
                    ->create([
                        'recipe_id' => $recipe,
                    ]);

                Comment::factory()
                    ->count(random_int(0, 5))
                    ->create([
                        'recipe_id' => $recipe,
                    ]);
            });
    }
}
