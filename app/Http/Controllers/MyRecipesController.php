<?php

namespace App\Http\Controllers;

class MyRecipesController extends Controller
{
    public function __invoke()
    {
        return view('recipes.my-recipes');
    }
}
