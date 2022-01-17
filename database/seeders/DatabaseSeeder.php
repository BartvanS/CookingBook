<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
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
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'a@a',
            'password' => Hash::make('a'),
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'is_admin' => true,
        ]);

        User::factory()->count(20)->create();

        User::get()->each(function (User $user): void {
            Recipe::factory()
                ->count(random_int(2, 4))
                ->create([
                    'user_id' => $user->id,
                    'category_id' => fn () => Category::inRandomOrder()->first(),
                ])
                ->each(function (Recipe $recipe): void {
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
                            'user_id' => fn () => random_int(1, 22),
                            'recipe_id' => $recipe,
                        ]);

                    $recipe->tags()->save(Category::inRandomOrder()->first());
                });
        });
    }
}
