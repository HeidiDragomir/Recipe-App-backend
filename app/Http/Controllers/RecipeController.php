<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllRecipes()
    {
        $recipes = Recipe::get()->toJson(JSON_PRETTY_PRINT);
        return response($recipes, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createRecipe(request $request)
    {
        $recipe = new Recipe;
        $recipe->title = $request->title;
        $recipe->ingredients = $request->ingredients;
        $recipe->save();

        return response()->json([
            "message" => "Recipe record has been created"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRecipe($id)
    {
        if (Recipe::where('id', $id)->exists()) {
            $recipe = Recipe::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($recipe, 200);
        } else {
            return response()->json([
                "message" => "Recipe not found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStudent(Request $request, $id)
    {
        if (Recipe::where('id', $id)->exists()) {
            $recipe = Recipe::find($id);
            $recipe->title = is_null($request->title) ? $recipe->title : $request->title;
            $recipe->ingredients = is_null($request->ingredients) ? $recipe->ingredients : $request->ingredients;
            $recipe->save();

            return response()->json([
                "message" => "Recipe records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Recipe not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteStudent($id)
    {
        if (Recipe::where('id', $id)->exists()) {
            $recipe = Recipe::find($id);
            $recipe->delete();

            return response()->json([
                "message" => "Recipe records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Recipe not found"
            ], 404);
        }
    }
}
