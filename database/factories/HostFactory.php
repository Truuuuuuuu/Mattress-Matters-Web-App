<?php

namespace Database\Factories;

use App\Models\Host;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostFactory extends Factory
{
    protected $model = Host::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
