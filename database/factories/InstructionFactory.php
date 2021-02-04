<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Instruction;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

final class InstructionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Instruction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'instruction' => $this->faker->realText(),
            'recipe_id' => fn () => Recipe::factory(),
        ];
    }
}
