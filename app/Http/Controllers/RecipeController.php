<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
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

    public function show(Recipe $recipe): RedirectResponse
    {
        // TODO: solid show page when the input fields are customizable to be set to sendform or view
        return redirect()->route('recipes.edit', $recipe);
    }

    public function edit(Request $request, Recipe $recipe)
    {
        abort_if($recipe->user->isNot($request->user()), Response::HTTP_UNAUTHORIZED);

        return view('recipes.edit', ['fields' => $recipe]);
    }

    public function update(Request $request, Recipe $recipe): RedirectResponse
    {
        abort_if($recipe->user->isNot($request->user()), Response::HTTP_UNAUTHORIZED);

        $validatedValues = $this->validateRecipe($request);

        $recipe->update($validatedValues);

        return redirect()->route('recipes.show', $recipe);
    }

    public function destroy(Request $request, Recipe $recipe): RedirectResponse
    {
        abort_if($recipe->user->isNot($request->user()), Response::HTTP_UNAUTHORIZED);

        $recipe->delete();

        return redirect()->route('recipes.index');
    }

    public function myRecipes()
    {
        $recipes = Recipe::where('user_id', Auth::id())->paginate(10);

        return view('recipes.myRecipes', [
            'recipes' => $recipes,
        ]);
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
