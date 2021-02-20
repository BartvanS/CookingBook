<?php

declare(strict_types=1);

use App\Http\Controllers\API\RecipeApiController;
use Illuminate\Http\Request;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::middleware('auth:sanctum')->group(function () {
//    Route::resource('recipes', RecipeApiController::class);
    Route::get('/recipes', [RecipeApiController::class, 'index'])->name('api.recipe.index');
    Route::post('/recipes', [RecipeApiController::class, 'store'])->name('api.recipe.store');
    Route::put('/recipes/{recipe}', [RecipeApiController::class, 'update'])->name('api.recipe.update');
    Route::delete('/recipes/{recipe}', [RecipeApiController::class, 'destroy'])->name('api.recipe.destroy');
});
