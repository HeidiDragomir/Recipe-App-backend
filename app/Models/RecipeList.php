<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title'
    ];
    public function recipe()
    {
        return $this->hasMany(Recipe::class)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
