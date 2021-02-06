<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Dto\RecipeCategory;
use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Repositories\RecipeRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\Ingredient;
use App\Models\Instruction;

/**
 * RecipeApiController
 *
 *  Edit the recipe via these api routes.
 *  You need a bearer token to connect. You can get this token from the website header profile button.
 * make sure you have the right permissions for what you want to achieve
 *  base path is "url"/api/recipes
 */
final class RecipeApiController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(['amount' => 'nullable|min:0|max:100']);

        return response(Recipe::limit($request->input('amount', 10))->get());
    }

    public function store(Request $request, RecipeRepository $recipeRepository)
    {
        $validatedValues = $this->validateRecipe($request);
   
        $recipeRepository->store($validatedValues);

        return 'kaas';
    }

    //todo: update

    private function validateRecipe($request): array
    {
        $values = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|string',
            'category' => ['required', 'string', Rule::in(RecipeCategory::all())],
            'duration' => 'digits_between:0,5',
            'ingredients' => 'required|json',
            'instructions' => 'required|json',
        ]);

        return $values;
        $values['duration'] = $values['duration'] ?: '0';
        $values['ingredients'] = collect($values['ingredients'])->filter()
        ->each(function (string $name, $index) {
            if (Str::length($name) > 255) {
                throw ValidationException::withMessages([
                    'ingredients' => sprintf('Ingredient %s cannot be longer than %s characters', $index + 1, 255),
                ]);
            }
        })
        ->map(fn (string $name) => Ingredient::make(['name' => $name]));
        $values['instructions'] = collect($values['instructions'])
            ->filter()
            ->map(fn (string $name) => Instruction::make(['instruction' => $name]));
        return $values;
    }
}
