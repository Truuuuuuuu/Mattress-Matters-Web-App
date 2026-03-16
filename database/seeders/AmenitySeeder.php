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
            ['name' => 'wifi', 'icon' => 'wifi', 'description' => 'Wifi'],
            ['name' => 'single_bed', 'icon' => 'bed-single', 'description' => 'Single Bed'],
            ['name' => 'bunk_bed', 'icon' => 'bed', 'description' => 'Bunk Bed'],
            ['name' => 'water_supply', 'icon' => 'droplet', 'description' => 'Water Supply'],
            ['name' => 'electricity', 'icon' => 'zap', 'description' => 'Electricity'],
            ['name' => 'parking', 'icon' => 'circle-parking', 'description' => 'Parking'],
            ['name' => 'study_table', 'icon' => 'book-open', 'description' => 'Study Table'],
            ['name' => 'exterior_cctv', 'icon' => 'cctv', 'description' => 'Exterior CCTV'],
        ];

       foreach ($amenities as $amenity)
       {
           Amenity::firstOrCreate([
               'name' => $amenity['name'],
               'icon' => $amenity['icon'],
               'description' => $amenity['description']
           ]);
       }
    }
}
