<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'recipeId',
        'title',
        'image'        
    ];

    public function recipelist()
    {
        return $this->belongsToMany(RecipeList::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
