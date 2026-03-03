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

        $amenities = [
            ['name' => 'wifi', 'icon' => 'wifi'],
            ['name' => 'single_bed', 'icon' => 'bed-single'],
            ['name' => 'bunk_bed', 'icon' => 'bed'],
            ['name' => 'water_supply', 'icon' => 'droplet'],
            ['name' => 'electricity', 'icon' => 'zap'],
            ['name' => 'parking', 'icon' => 'circle-parking'],
            ['name' => 'study_table', 'icon' => 'book-open'],
            ['name' => 'exterior_cctv', 'icon' => 'cctv'],
        ];

       foreach ($amenities as $amenity)
       {
           Amenity::firstOrCreate([
               'name' => $amenity['name'],
               'icon' => $amenity['icon']
           ]);
       }
    }
}
