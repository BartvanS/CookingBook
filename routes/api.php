<?php

declare(strict_types=1);

use App\Http\Controllers\API\RecipeApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('recipes', [RecipeApiController::class, 'index'])->name('api.recipes.index');
    Route::post('recipes', [RecipeApiController::class, 'create'])->name('api.recipes.create');
    Route::get('recipes/{recipe}', [RecipeApiController::class, 'show'])->name('api.recipes.show');
});
