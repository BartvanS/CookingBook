<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\RecipeCategory;
use App\Models\Ingredient;
use App\Models\Instruction;
use App\Models\Recipe;
use App\Repositories\RecipeRepository;
use App\Services\DurationConverter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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

    public function store(Request $request, RecipeRepository $recipeRepository): RedirectResponse
    {
        $validatedValues = $this->validateRecipe($request);
        $recipe = $recipeRepository->store($request, $validatedValues, $validatedValues['ingredients'], $validatedValues['instructions']);

        return redirect()->route('recipes.show', $recipe);
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show')->with('recipe', $recipe);
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit')->with([
            'recipe' => $recipe,
            'ingredients' => $recipe->ingredients->pluck('name')->toArray(),
            'instructions' => $recipe->instructions()->pluck('instruction')->toArray(),
        ]);
    }

    public function update(Request $request, Recipe $recipe, RecipeRepository $recipeRepository): RedirectResponse
    {
        $validatedValues = $this->validateRecipe($request);
        $recipe = $recipeRepository->update($request, $recipe, $validatedValues);
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
            'category' => ['required', 'string', Rule::in(RecipeCategory::all())],
            'duration' => 'required|string|min:5|max:5',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
        ]);

        $values['duration'] = DurationConverter::toMinutes($values['duration']);

        $values['ingredients'] = collect(explode(PHP_EOL, $values['ingredients']))
            ->filter()
            ->each(function (string $name, $index) {
                if (Str::length($name) > 255) {
                    throw ValidationException::withMessages([
                        'ingredients' => sprintf('Ingredient %s cannot be longer than %s characters', $index + 1, 255),
                    ]);
                }
            })
            ->map(fn (string $name) => Ingredient::make(['name' => $name]));

        $values['instructions'] = collect(explode(PHP_EOL, $values['instructions']))
            ->filter()
            ->map(fn (string $name) => Instruction::make(['instruction' => $name]));

        return $values;
    }
}
