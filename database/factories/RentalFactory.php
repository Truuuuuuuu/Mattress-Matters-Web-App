<?php

namespace Database\Factories;

use App\Models\Rental;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalFactory extends Factory
{
    protected $model = Rental::class;

    public function definition(): array
    {
        return [
            'tenant_id'        => 1,
            'listing_id'       => 2,
            'reservation_id'   => 1,
            'status'           => 'ended',
            'lease_start_date' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d H:i:s'),
            'ended_at'         => null,
        ];
    }
}
