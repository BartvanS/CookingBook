<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Instruction;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

final class InstructionFactory extends Factory
{
    protected $model = Instruction::class;

    public function definition(): array
    {
        return [
            'instruction' => $this->faker->realText(),
            'recipe_id' => fn () => Recipe::factory(),
        ];
    }
}
