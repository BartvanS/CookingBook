<?php

declare(strict_types=1);

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('recipes', RecipeController::class);
    Route::get('author/{user}', [AuthorController::class, 'show'])->name('author.show');
});

Route::get('/hondje', DogController::class)->name('hondje');
