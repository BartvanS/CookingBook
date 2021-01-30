<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Recipe::class);
    }

    public function index()
    {
        return view('recipes.index');
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedValues = $this->validateRecipe($request);

        $recipe = new Recipe();
        $recipe->fill($validatedValues);
        $recipe->user()->associate($request->user());
        $recipe->save();

        return redirect()->route('recipes.show', $recipe);
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show')->with('recipe', $recipe);
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', ['fields' => $recipe]);
    }

    public function update(Request $request, Recipe $recipe): RedirectResponse
    {
        $validatedValues = $this->validateRecipe($request);

        $recipe->update($validatedValues);

        return redirect()->route('recipes.show', $recipe);
    }

    public function destroy(Recipe $recipe): RedirectResponse
    {
        $recipe->delete();

        return redirect()->route('recipes.index');
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
