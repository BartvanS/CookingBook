<?php

use App\Http\Controllers\DogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('recipes.index');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('recipes', \App\Http\Controllers\RecipeController::class);
Route::get('myrecipes', [\App\Http\Controllers\RecipeController::class, 'myRecipes'])->name('recipes.myrecipes');

Route::get('/hondje', DogController::class)->name('hondje');
