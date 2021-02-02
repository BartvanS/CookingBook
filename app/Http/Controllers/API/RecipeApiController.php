<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

final class RecipeApiController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(['amount' => 'nullable|min:0|max:100']);

        return response(Recipe::limit($request->input('amount', 10))->get());
    }

    public function store(Request $request)
    {
        $validatedValues = $this->validateRecipe($request);
        $recipe = new Recipe();
        $recipe->fill($validatedValues);
        $recipe->user()->associate($request->user());
        $recipe->save();

        return 'succes';
    }

    private function validateRecipe($request): array
    {
        $validationValues = [
            'title' => 'required|max:255',
            'description' => 'required|string',
            'hours' => 'nullable|max:255',
            'minutes' => 'nullable|max:255',
            'ingredients' => 'required|string',
        ];

        return $request->validate($validationValues);
    }
}
