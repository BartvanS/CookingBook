<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'message' => $this->faker->paragraph,
            'user_id' => fn () => User::factory(),
            'recipe_id' => fn () => Recipe::factory(),
        ];
    }
}
