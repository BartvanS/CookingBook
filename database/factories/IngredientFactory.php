<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

final class IngredientFactory extends Factory
{
    protected $model = Ingredient::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->numberBetween(1, 10) . 'x ' . $this->faker->sentence(2),
            'recipe_id' => fn () => Recipe::factory(),
        ];
    }
}
