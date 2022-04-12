<?php

namespace App\Http\Controllers;

use App\Models\Rlist;
use Illuminate\Http\Request;

class RlistController extends Controller
{

    public function store(Request $request)
    {
        if (Rlist::where('recipe_id', $request->recipe_id)->where('recipe_list_id', $request->recipe_list_id)->exists()) {
            return response()->json([
                "message" => "Recipe is already in that list!"
            ], 409);
        } else {

            if (Rlist::where('recipe_list_id', $request->recipe_list_id)->exists()) {

                $attributes = request()->validate([
                    'recipe_list_id' => 'required',
                    'recipe_id' => 'required'
                ]);
                Rlist::create($attributes);
                return response()->json([
                    "message" => "Recipe added to list"
                ], 201);
            } else {
                return response()->json([
                    "message" => "List not found"
                ], 404);
            }
        }
    }

    public function destroy()
    {

        $recipe_id = request('recipe_id');
        $recipe_list_id = request('recipe_list_id');


        Rlist::where('recipe_id', $recipe_id)->where('recipe_list_id', $recipe_list_id)->delete();

        return response()->json([
            "message" => "Record deleted"
        ], 201);
    }
}
