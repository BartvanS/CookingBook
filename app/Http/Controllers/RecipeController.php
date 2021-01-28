<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{

    public function __construct()
    {
        //todo: add middleware for everypage except index/show for check if user is allowed to do action
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('recipes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedValues = $this->validateRecipe($request);
        $recipe = new Recipe();
        $recipe = $this->recipeFields($recipe, $validatedValues);
        $recipe->save();
        return redirect()->route('recipes.show', [$recipe]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(int $id)
    {
        //todo: solid show page when the input fields are customizable to be set to sendform or view
        return redirect()->route('recipes.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $recipe = Recipe::findOrFail($id);
        if ($this->checkAuth($recipe->user->id)) {
            return view('recipes.edit', ['fields' => $recipe]);
        } else {
            return abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, int $id)
    {
        $recipe = Recipe::find($id);
        if ($this->checkAuth($recipe->user->id)) {
            $validatedValues = $this->validateRecipe($request);
            $recipe = $this->recipeFields($recipe, $validatedValues);
            $recipe->save();
        } else {
            return abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $recipeId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $recipeId)
    {
        $recipe = Recipe::find($recipeId);
        if ($this->checkAuth($recipe->user->id)) {
            $recipe->delete();
            return redirect()->route('recipes.index');
        } else {
            abort(401);
        }
    }

    public function myRecipes(){
        $recipes = Recipe::where('user_id', \Illuminate\Support\Facades\Auth::id())->paginate(10);

        return view('recipes.myRecipes', [
            'recipes' => $recipes,
        ]);
    }
    /**
     * Return the validated values if successfull
     *
     * @param $request
     * @return string[]
     */
    private function validateRecipe($request)
    {
        $validationValues = [
            'title' => 'required|max:255',
            'description' => 'required|string',
            'hours' => 'max:255',
            'minutes' => 'max:255',
            'ingredients' => 'required|string',
        ];
        return $request->validate($validationValues);
    }

    private function recipeFields($recipe, $validatedValues)
    {
        $recipe->title = $validatedValues['title'];
        $recipe->description = $validatedValues['description'];
        $recipe->ingredients = $validatedValues['ingredients'];
        $recipe->hours = $validatedValues['hours'] ? $validatedValues['hours'] : 0;
        $recipe->minutes = $validatedValues['minutes'] ? $validatedValues['minutes'] : 0;
        $recipe->user_id = Auth::id();
        return $recipe;
    }

    private function checkAuth($user_id)
    {
        return $user_id == Auth::id();
    }


}
