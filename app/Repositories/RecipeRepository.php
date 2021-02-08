<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Recipe;

final class RecipeRepository
{
    /**
     * Store a new recipe in the database based on the
     * @param array $validatedValues
     * @return Recipe
     */
    public function create(array $validatedValues): Recipe
    {
        $recipe = new Recipe();
        $recipe->fill($validatedValues);

        $recipe->category()->associate($validatedValues['category']);

        $recipe->save();

        $recipe->ingredients()->saveMany($validatedValues['ingredients']);

        $recipe->instructions()->saveMany($validatedValues['instructions']);

        return $recipe;
    }

    /**
     * Update a recipe in the database
     * @param Recipe $recipe
     * @param array $validatedValues
     * @return Recipe
     */
    public function update(Recipe $recipe, array $validatedValues): Recipe
    {
        $recipe->category()->associate($validatedValues['category']);
        $recipe->update($validatedValues);

        $recipe->ingredients()->delete();
        $recipe->ingredients()->saveMany($validatedValues['ingredients']);

        $recipe->instructions()->delete();
        $recipe->instructions()->saveMany($validatedValues['instructions']);

        return $recipe;
    }
}
