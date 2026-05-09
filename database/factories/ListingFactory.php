<?php

namespace Database\Factories;

use App\Models\Host;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    protected $model = Listing::class;

    public function definition(): array
    {
        return [
            'host_id' => 1,
            'title' => fake()->company(),
            'address' => fake()->address(),
            'description' => fake()->text(10),
            'rent_cost' => fake()->randomFloat(2, 1500, 3000),
            'electricity_cost' => fake()->randomFloat(2, 0, 500),
            'water_supply_cost' => fake()->randomFloat(2, 0, 500),
            'availability' => 'available',
            'status' => 'active',
            'slot' => fake()->numberBetween(2,9),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
