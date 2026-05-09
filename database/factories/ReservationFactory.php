<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tenant_id'      => 1,
            'listing_id'     => 1,
            'start_date'     => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'status'         => 'accepted',
            'payment_status' => 'paid',
            'cancelled_by'   => null,
        ];
    }
}
