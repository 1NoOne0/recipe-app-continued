<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientsTableSeeder extends Seeder
{
    public function run()
    {
        $ingredients = [
            'Salt',
            'Pepper',
            'Olive Oil',
            'Chicken',
            'Beef',
            'Garlic',
            'Onion',
            'Tomato',
            'Lettuce',
            'Cheese'
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create([
                'name' => $ingredient,
            ]);
        }
    }
}
