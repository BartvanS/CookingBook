<?php

declare(strict_types=1);

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\Recipes\MyRecipesController;
use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('recipes', RecipeController::class);
    Route::get('/my-recipes', MyRecipesController::class)->name('my-recipes');
    Route::get('author/{user}', [AuthorController::class, 'show'])->name('author.show');

    Route::middleware('can:admin')
        ->get('health', HealthCheckResultsController::class);
});

Route::get('/hondje', DogController::class)->name('hondje');
