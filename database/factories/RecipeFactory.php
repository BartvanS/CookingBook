<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->realText(),
            'duration' => rand(1, 150),
            'yield' => rand(1, 8),
            'user_id' => fn () => User::factory(),
            'category_id' => fn () => Category::factory(),
            'created_at' => $this->faker->dateTimeBetween('-1 years'),
        ];
    }

    public function images(): self
    {
        return $this->state(function () {
            $number = $this->faker->numberBetween(0, 9);
            $image = $number === 0 ? null : $number . '.jpeg';

            return [
                'thumbnail' => $image,
                'image' => $image,
            ];
        });
    }
}
