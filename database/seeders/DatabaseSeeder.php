<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Recipe;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            RecipesTableSeeder::class,
            IngredientsTableSeeder::class,
            ReviewsTableSeeder::class,
        ]);

    }
}
