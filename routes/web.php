<?php

declare(strict_types=1);

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/hondje', DogController::class)->name('hondje');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('recipes', RecipeController::class);

    Route::get('author/{user}', [AuthorController::class, 'show'])->name('author.show');
});

Route::middleware(['auth', 'can:admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserController::class)->except('show');

    Route::resource('categories', CategoryController::class)->except(['show', 'destroy']);
});
