<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\asset>
 */
class assetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      
        $users = collect(User::all()->modelKeys());
    
        return [
            'assetno' =>'F' . $this->faker->numberBetween(100,700),
            'user_id' => $users->random(),

        ];
    }
}


