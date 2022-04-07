<?php

namespace App\Http\Controllers;

use App\Models\RecipeList;
use Illuminate\Http\Request;

class RecipeListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllList()
    {
        $list = RecipeList::get()->toJson(JSON_PRETTY_PRINT);
        return response($list, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createList(request $request)
    {
        $list = new RecipeList();
        $list->title = $request->title;
        $list->user_id = $request->user()->id;
        $list->save();

        /* $attributes['title'] = $request->title;
        $attributes['user_id'] = $request->user()->id;
        RecipeList::create($attributes); */

        return response()->json([
            "message" => "List record has been created"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getList($id)
    {
        if (RecipeList::where('id', $id)->exists()) {
            $list = RecipeList::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($list, 200);
        } else {
            return response()->json([
                "message" => "List not found"
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

    public function updateList(Request $request, $id)
    {
        if (RecipeList::where('id', $id)->exists()) {
            $list = RecipeList::find($id);
            $list->title = is_null($request->title) ? $list->title : $request->title;
            $list->save();

            return response()->json([
                "message" => "List records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "List not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteList($id)
    {
        if (RecipeList::where('id', $id)->exists()) {
            $list = RecipeList::find($id);
            $list->delete();

            return response()->json([
                "message" => "List records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "List not found"
            ], 404);
        }
    }
}
