<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeList;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAllRecipes(Request $request)
    {
        $id = $request->user()->id;
        $list = Recipe::where('user_id', $id)->get()->toJson(JSON_PRETTY_PRINT); ////am sters RecipeList
        return response($list, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function addRecipe(Request $request)
    {

        if (Recipe::where('recipeId', $request->recipeId)->where('user_id', $request->user()->id)->exists()) {

            return response()->json(['message' => 'Recipe already exist!'], 409);
        } else {
            $attributes = request()->validate([
                
                'recipeId' => 'required',
                'title' => 'required',
                'image' => 'required',
                // 'recipe_list_id' => 'required',
            ]);
            $attributes['user_id'] = $request->user()->id;

            Recipe::create($attributes);
            return response()->json(['message' => 'Recipe added!'], 201);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteRecipe($id)
    {
        if (Recipe::where('id', $id)->exists()) {
            $recipe = Recipe::find($id);
            $recipe->delete();

            return response()->json([
                "message" => "Recipe deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Recipe not found"
            ], 404);
        }
    }
}
