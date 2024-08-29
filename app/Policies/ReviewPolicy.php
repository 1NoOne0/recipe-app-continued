<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
{

    public function delete(User $user, Review $review)
    {
        // Admins can delete any review
        if ($user->hasRole('admin')) {
            return true;
        }

        // Registered users can delete their own reviews
        return $user->email === $review->author_email;
    }

}
