<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Dto\RecipeCategory;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class RecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->realText(),
            'duration' => rand(1, 150),
            'user_id' => fn () => User::factory(),
            'category' => $this->faker->randomElement(RecipeCategory::all()),
        ];
    }
}
