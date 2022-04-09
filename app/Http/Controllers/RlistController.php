<?php

namespace App\Http\Controllers;

use App\Models\Rlist;
use Illuminate\Http\Request;

class RlistController extends Controller
{
    public function store(Request $request)
    {
        if (Rlist::where('recipe_id', $request->recipe_id)->where('recipe_list_id', $request->recipe_list_id)->exists()) {
            return back()->with([
                'success' => 'Recipe is already in that list!',
                'color' => 'danger'
            ]);
        } else {
            $attributes = request()->validate([
                'recipe_list_id' => 'required',
                'recipe_id' => 'required'
            ]);
            Rlist::create($attributes);
            return back()->with([
                'success' => 'Recipe added to list!',
                'color' => 'success'
            ]);
        }
    }



    public function destroy()
    {

        $recipeId = request('recipe_id');
        $recipelistId = request('recipe_list_id');


        Rlist::where('recipe_id', $recipeId)->where('recipe_list_id', $recipelistId)->delete();
        return back()->with([
            'success' => 'Recipe Deleted From List!',
            'color' => 'danger'
        ]);
    }
}
