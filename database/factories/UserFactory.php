<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'username' => $this->faker->userName(), // Use 'username' instead of 'name'
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // default password
            'remember_token' => Str::random(10),
        ];
    }
}
