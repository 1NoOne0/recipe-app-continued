<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Recipe::create([
            'name' => 'Chicken Nuggets',
            'description' => 'Delicious crispy chicken nuggets that are golden brown and tender on the inside.',
            'preparation_time' => 30,
            'meal_time' => 'lunch',
            'author' => 2,
        ]);

        Recipe::create([
            'name' => 'Veggie Delight',
            'description' => 'A fresh and vibrant mix of seasonal vegetables, lightly seasoned and roasted to perfection.',
            'preparation_time' => 45,
            'meal_time' => 'dinner',
            'author' => 3,
        ]);

        Recipe::create([
            'name' => 'Classic Lasagna',
            'description' => 'Layered pasta with rich beef and tomato sauce, creamy béchamel, and gooey mozzarella.',
            'preparation_time' => 90,
            'meal_time' => 'dinner',
            'author' => 2,
        ]);

        Recipe::create([
            'name' => 'Chocolate Chip Cookies',
            'description' => 'Soft and chewy cookies loaded with melty chocolate chips, perfect for any sweet tooth.',
            'preparation_time' => 25,
            'meal_time' => 'breakfast',
            'author' => 4,
        ]);
        Recipe::create([
            'name' => 'Spicy Tofu Stir-fry',
            'description' => 'Crispy tofu stir-fried with fresh veggies and a spicy, savory sauce. Great for a quick dinner.',
            'preparation_time' => 20,
            'meal_time' => 'dinner',
            'author' => 3,
        ]);

        Recipe::create([
            'name' => 'Garlic Butter Shrimp',
            'description' => 'Juicy shrimp sautéed in a rich garlic butter sauce, served over a bed of fluffy rice.',
            'preparation_time' => 20,
            'meal_time' => 'dinner',
            'author' => 4,
        ]);

        $user = User::find(4);

        Recipe::create([
            'name' => 'Example Recipe',
            'description' => 'This is an example description.',
            'preparation_time' => 30,
            'meal_time' => 'dinner',
            'author' => $user->id,
        ]);
    }
}
