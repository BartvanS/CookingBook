<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\Instruction;
use App\Models\Recipe;
use App\Repositories\RecipeRepository;
use App\Services\DurationConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * RecipeApiController
 *
 *  Edit the recipe via these api routes.
 *  You need a bearer token to connect. You can get this token from the website header profile button.
 * make sure you have the right permissions for what you want to achieve
 *  base path is "url"/api/recipes for mor info look at the docs for resource controllers
 */
final class RecipeApiController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $values = $request->validate(['amount' => 'nullable']);

        return response(Recipe::limit($values['amount'] ?? 10)->get());
    }

    /**
     * @return string
     *
     * @throws ValidationException
     */
    public function store(Request $request, RecipeRepository $recipeRepository)
    {
        $validatedValues = $this->validateRecipe($request);
        $recipe = $recipeRepository->create($validatedValues);

        return response()->json($validatedValues);

        return 'success';
    }

    //todo: update && retrieve custom

    /**
     * @param $request
     *
     * @throws ValidationException
     */
    private function validateRecipe(Request $request): array
    {
        $values = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|string',
            'category' => 'required|exists:categories,id',
            'duration' => 'required|string|min:5|max:5',
            'ingredients' => 'array',
            'instructions' => 'array',
        ]);

        $values['duration'] = DurationConverter::toMinutes($values['duration']);
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
        $values['image'] = null;

        return $values;
    }
}
