<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\MyRecipesController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/hondje', DogController::class)->name('hondje');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('recipes', RecipeController::class);
    Route::get('my-recipes', MyRecipesController::class)->name('my-recipes');
});
