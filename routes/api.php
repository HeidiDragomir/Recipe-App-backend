<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;
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

// Public routes
/* Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']); */
Route::get('/recipes', [RecipeController::class, 'getAllRecipes']);
Route::get('/recipes/{id}', [RecipeController::class, 'getRecipe']);
// Route::get('/recipes/search/{name}', [RecipeController::class, 'search']);

Route::post('/recipes', [RecipeController::class, 'createRecipe']);
// Protected routes
/* Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/recipes', [RecipeController::class, 'createRecipe']);
    Route::put('/recipes/{id}', [RecipeController::class, 'updateRecipe']);
    Route::delete('/recipes/{id}', [RecipeController::class, 'deleteRecipe']);
    Route::post('/logout', [AuthController::class, 'logout']);
}); */



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
