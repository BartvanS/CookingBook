<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Recipe;

final class RecipeRepository
{

    /**
     * store a new recipe in the database based on the 
     *
     * @param  array $validatedValues
     * @return Recipe $recipe
     */
    public function store($validatedValues)
    {
        $recipe = new Recipe();
        $recipe->fill($validatedValues);
        $recipe->save();

        $recipe->ingredients()->saveMany($validatedValues['ingredients']);

        $recipe->instructions()->saveMany($validatedValues['instructions']);

        return $recipe;
    }

    /**
     * update a recipe in the database
     *
     * @param  Recipe $recipe
     * @param  array $validatedValues
     * @return Recipe $recipe
     */
    public function update($recipe, $validatedValues)
    {
        $recipe->update($validatedValues);
        $recipe->ingredients()->delete();
        $recipe->ingredients()->saveMany($validatedValues['ingredients']);
        $recipe->instructions()->delete();
        $recipe->instructions()->saveMany($validatedValues['instructions']);

        return $recipe;
    }
}
