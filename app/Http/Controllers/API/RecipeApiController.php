<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Models\Ingredient;
use App\Models\Instruction;
use App\Models\Recipe;
use App\Repositories\RecipeRepository;
use App\Services\DurationConverter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
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
    public function index(Request $request): ResourceCollection
    {
        $this->authorize('viewAny', Recipe::class);

        $values = $request->validate([
            'search' => ['nullable', 'string'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $recipes = Recipe::with('instructions', 'ingredients', 'user')
            ->when($values['search'] ?? false, function (Builder $query, string $search) {
                $query->where(function (Builder $query) use ($search) {
                    $search = '%' . $search . '%';
                    $query
                        ->where('title', 'like', $search)
                        ->orWhere('description', 'like', $search)
                        ->orWhereHas('ingredients', fn (Builder $query) => $query->where('name', 'like', $search))
                        ->orWhereHas('instructions', fn (Builder $query) => $query->where('instruction', 'like', $search));
                });
            })
            ->limit($values['limit'] ?? 10)
            ->latest()
            ->get();

        return RecipeResource::collection($recipes);
    }

    public function create(Request $request, RecipeRepository $recipeRepository): RecipeResource
    {
        $this->authorize('create', Recipe::class);

        $validatedValues = $this->validateRecipe($request);

        $recipe = $recipeRepository->create($validatedValues);

        return RecipeResource::make($recipe);
    }

    public function show(Recipe $recipe): RecipeResource
    {
        $this->authorize('view', $recipe);

        return RecipeResource::make($recipe);
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
            'ingredients' => 'required|array|min:1',
            'instructions' => 'required|array|min:1',
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
