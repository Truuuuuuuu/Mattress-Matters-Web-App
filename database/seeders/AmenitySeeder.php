<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Amenity::firstOrCreate([
            'name' => 'wifi',
            'icon' => 'wifi'
        ]);

        Amenity::firstOrCreate([
            'name' => 'bed',
            'icon' => 'bed-single'
        ]);

        Amenity::firstOrCreate([
            'name' => 'water_supply',
            'icon' => 'droplet'
        ]);

        Amenity::firstOrCreate([
            'name' => 'study_table',
            'icon' => 'book-open'
        ]);

        Amenity::firstOrCreate([
            'name' => 'parking',
            'icon' => 'circle-parking'
        ]);

    }
}
