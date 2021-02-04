<?php
namespace App\Repositories;
use App\Models\Recipe;

class RecipeRepository
{
    public function store($request, $validatedValues)
    {
        $recipe = new Recipe();
        $recipe->fill($validatedValues);
        $recipe->user()->associate($request->user());
        $recipe->save();

        $recipe->ingredients()->saveMany($validatedValues['ingredients']);

        $recipe->instructions()->saveMany($validatedValues['instructions']);
        return $recipe;
    }
    public function update()
    {
    }
}
