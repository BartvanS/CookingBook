<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RecipeController;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeApiController extends Controller
{
    public function index(){
        return "kaas";
    }

    public function store(Request $request){
        $validatedValues = $this->validateRecipe($request);
        $recipe = new Recipe();
        $recipe->fill($validatedValues);
        $recipe->user()->associate($request->user());
        $recipe->save();

        return 'succes';
//        $request->json();
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
