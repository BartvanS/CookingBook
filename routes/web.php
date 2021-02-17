<?php

declare(strict_types=1);

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/hondje', DogController::class)->name('hondje');

//Route::middleware(['auth', 'verified'])->group(function () {
//    });
Route::get('/', DashboardController::class)->name('dashboard')->middleware(['auth', 'verified']);

Route::resource('recipes', RecipeController::class)->middleware(['auth', 'verified']);

Route::get('author/{user}', [AuthorController::class, 'show'])->name('author.show')->middleware(['auth', 'verified']);
