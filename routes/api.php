<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeListController;
use App\Models\RecipeList;
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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Route::get('/recipes/search/{name}', [RecipeController::class, 'search']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    //LISTS

    Route::get('/recipelist', [RecipeListController::class, 'getAllLists']);

    Route::get('/recipelist/{id}', [RecipeListController::class, 'getList']);

    Route::post('/recipelist', [RecipeListController::class, 'createList']);

    Route::put('/recipelist/{id}', [RecipeListController::class, 'updateList']);

    Route::delete('/recipelist/{id}', [RecipeListController::class, 'deleteList']);

    //RECIPES

    Route::post('/recipe', [RecipeController::class, 'addRecipe']);

    Route::delete('/recipe/{id}', [RecipeController::class, 'deleteRecipe']);

    Route::post('/logout', [AuthController::class, 'logout']);
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
