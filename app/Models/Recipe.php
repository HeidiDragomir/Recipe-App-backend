<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'recipe_list_id',
        'recipeId',
        'title',
        'image'        
    ];

    public function recipelist()
    {
        return $this->belongsToMany(RecipeList::class);
    }
}
