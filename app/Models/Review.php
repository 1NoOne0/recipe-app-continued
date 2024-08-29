<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['author_email', 'recipe_id', 'rating', 'text'];

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_email', 'email');
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id', 'id');
    }
}
