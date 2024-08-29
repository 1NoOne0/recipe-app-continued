<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecipePolicy
{

    public function delete(User $user, Recipe $recipe)
    {
        // Admins can delete any recipe
        if ($user->hasRole('admin')) {
            return true;
        }

        // Registered users can delete their own recipes
        return $user->email === $recipe->author;
    }
}