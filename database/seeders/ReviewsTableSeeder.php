<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        // Reviews for Recipe One
        Review::create([
            'author_id' => 2, // Assuming this is the ID of UserTwo
            'recipe_id' => 1, // Assuming this is the ID of Recipe One
            'rating' => 5,
            'text' => 'Amazing recipe! Loved it.',
        ]);

        Review::create([
            'author_id' => 3, // Assuming this is the ID of UserThree
            'recipe_id' => 1, // Assuming this is the ID of Recipe One
            'rating' => 4,
            'text' => 'Very good, but a bit too salty.',
        ]);

        // Reviews for Recipe Two
        Review::create([
            'author_id' => 1, // Assuming this is the ID of UserOne
            'recipe_id' => 2, // Assuming this is the ID of Recipe Two
            'rating' => 5,
            'text' => 'Delicious and easy to make!',
        ]);

        Review::create([
            'author_id' => 3, // Assuming this is the ID of UserThree
            'recipe_id' => 2, // Assuming this is the ID of Recipe Two
            'rating' => 3,
            'text' => 'Good, but could use more spices.',
        ]);
    }
}
