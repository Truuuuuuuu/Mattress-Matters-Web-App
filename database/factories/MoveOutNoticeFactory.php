<?php

namespace Database\Factories;

use App\Models\MoveOutNotice;
use Illuminate\Database\Eloquent\Factories\Factory;

class MoveOutNoticeFactory extends Factory
{
    protected $model = MoveOutNotice::class;

    public function definition(): array
    {
        return [
            'rental_id'       => 8,
            'move_out_date' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'reason'   => 'change plan',
            'status'           => 'active',
            'cancelled_at'         => null,
        ];
    }
}
