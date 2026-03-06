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
            ['title' => 'no_pets', 'name' => 'pet_rule' , 'description' => 'No pets allowed', 'category' => 'pet', 'icon' => 'fish-off'],
            ['title' => 'one_pet', 'name' => 'pet_rule' , 'description' => 'One pet allowed', 'category' => 'pet', 'icon' => 'paw-print'],
            ['title' => 'curfew_10pm','name' => 'curfew_rule' , 'description' => 'Curfew at 10pm', 'category' => 'curfew', 'icon' => 'clock-alert'],
            ['title' => 'no_curfew', 'name' => 'curfew_rule' , 'description' => 'No curfew', 'category' => 'curfew', 'icon' => 'clock-check'],
            ['title' => 'no_smoking', 'name' => 'smoking_rule' , 'description' => 'No smoking', 'category' => 'smoking', 'icon' => 'cigarette-off'],
            ['title' => 'smoking_allowed', 'name' => 'smoking_rule' , 'description' => 'Smoking allowed in designated area', 'category' => 'smoking', 'icon' => 'cigarette'],
            ['title' => 'no_guests', 'name' => 'guest_rule' , 'description' => 'No guests allowed', 'category' => 'guest', 'icon' => 'user-round-x'],
            ['title' => 'guest_allowed', 'name' => 'guest_rule' , 'description' => 'Guest allowed with prior notice', 'category' => 'guest', 'icon' => 'users'],
        ];

        foreach ($rules as $rule) {
            Rule::firstOrCreate([
                'title' => $rule['title'],
                'name' => $rule['name'],
                'description' => $rule['description'],
                'category' => $rule['category'],
                'icon' => $rule['icon'],
            ]);
        }
    }

}
