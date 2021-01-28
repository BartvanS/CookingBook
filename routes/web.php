<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return redirect()->route('recipes.index');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('recipes', \App\Http\Controllers\RecipeController::class);
Route::get('myrecipes', [\App\Http\Controllers\RecipeController::class, 'myRecipes'])->name('recipes.myrecipes');

/*
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * legacy code, dont remove or code breaks!
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/
Route::get('/hondje', function () {
    $dogs = array(
        'pug.gif',
        'bruin.gif',
        'wit.gif',
        'witsmol.gif',
        'witzwart.gif',
        'zwart.gif',
    );
    $selectedDog = array_rand($dogs);
    $path = asset('img/' . $dogs[$selectedDog]);
    return '<img src="'. $path .'" width="30%"  alt="'. $dogs[$selectedDog] .'">';
});
