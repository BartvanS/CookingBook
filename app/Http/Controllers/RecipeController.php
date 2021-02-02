<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Services\DurationConverter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class RecipeController extends Controller
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
        return view('recipes.edit')->with('recipe', $recipe);
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

    private function validateRecipe(Request $request): array
    {
        $values = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|string',
            'duration' => 'required|string|min:5|max:5',
            'ingredients' => 'required|string',
        ]);

        $values['duration'] = DurationConverter::toMinutes($values['duration']);

        return $values;
    }
}
