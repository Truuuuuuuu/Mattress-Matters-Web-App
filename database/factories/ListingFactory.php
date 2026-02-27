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
            'host_id' => Host::factory(),
            'name' => fake()->company(),
            'address' => fake()->address(),
            'description' => fake()->text(10),
            'price' => fake()->randomFloat(2, 1500, 3000),
            'status' => fake()->randomElement(['available', 'unavailable']),
            'gender' => fake()->randomElement(['male', 'female']),
            'tenant_type' => fake()->randomElement(['student', 'regular']),
            'slot' => fake()->numberBetween(2,9),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
