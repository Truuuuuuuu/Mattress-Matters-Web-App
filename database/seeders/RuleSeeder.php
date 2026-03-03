<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            ['name' => 'no_pets', 'description' => 'No pets allowed', 'category' => 'pet', 'icon' => 'fish-off'],
            ['name' => 'one_pet', 'description' => 'One pet allowed', 'category' => 'pet', 'icon' => 'paw-print'],
            ['name' => 'curfew_10pm', 'description' => 'Curfew at 10pm', 'category' => 'curfew', 'icon' => 'clock-alert'],
            ['name' => 'no_curfew', 'description' => 'No curfew', 'category' => 'curfew', 'icon' => 'clock-check'],
            ['name' => 'no_smoking', 'description' => 'No smoking', 'category' => 'smoking', 'icon' => 'cigarette-off'],
            ['name' => 'smoking_allowed', 'description' => 'Smoking allowed in designated area', 'category' => 'smoking', 'icon' => 'cigarette'],
            ['name' => 'no_guests', 'description' => 'No guests allowed', 'category' => 'guest', 'icon' => 'user-round-x'],
            ['name' => 'guest_allowed', 'description' => 'Guest allowed with prior notice', 'category' => 'guest', 'icon' => 'users'],
        ];

        foreach ($rules as $rule) {
            Rule::firstOrCreate([
                'name' => $rule['name'],
                'description' => $rule['description'],
                'category' => $rule['category'],
                'icon' => $rule['icon'],
            ]);
        }
    }

}
