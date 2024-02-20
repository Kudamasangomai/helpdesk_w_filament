<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\asset;
use App\Models\fault;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\repair>
 */
class repairFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        {
            $asset = collect(asset::all()->modelKeys());
            $users = collect(User::all()->modelKeys());
            $fault = collect(fault::all()->modelKeys());
            return [
                'asset_id' => $asset->random(),
                'fault_id' => $fault->random(),
                'user_id' => $users->random(),
                'assigneduser' => $users->random(),
                'workdone'=> 'n/a'
    
            ];
        }
    }
}
