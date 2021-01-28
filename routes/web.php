<?php

use App\Http\Controllers\DogController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('recipes.index');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('recipes', RecipeController::class);
    Route::get('myrecipes', [RecipeController::class, 'myRecipes'])->name('recipes.myrecipes');
});

Route::get('/hondje', DogController::class)->name('hondje');
