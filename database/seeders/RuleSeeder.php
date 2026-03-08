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
            /*Gender rule*/
            ['title' => 'male_only', 'name' => 'gender_rule' , 'description' => 'Male only', 'category' => 'gender', 'icon' => 'mars'],
            ['title' => 'female_only', 'name' => 'gender_rule' , 'description' => 'Female only', 'category' => 'gender', 'icon' => 'venus'],
            ['title' => 'any_gender', 'name' => 'gender_rule' , 'description' => 'Any gender', 'category' => 'gender', 'icon' => 'venus-and-mars'],
            /*Tenant rule*/
            ['title' => 'students_only', 'name' => 'tenant_rule' , 'description' => 'Students only', 'category' => 'tenant', 'icon' => 'graduation-cap'],
            ['title' => 'working_individuals', 'name' => 'tenant_rule' , 'description' => 'Working individuals', 'category' => 'tenant', 'icon' => 'briefcase-business'],
            ['title' => 'anyone', 'name' => 'tenant_rule' , 'description' => 'Open to anyone', 'category' => 'tenant', 'icon' => 'user-check'],
            /*Pet rule*/
            ['title' => 'no_pets', 'name' => 'pet_rule' , 'description' => 'No pets allowed', 'category' => 'pet', 'icon' => 'fish-off'],
            ['title' => 'one_pet', 'name' => 'pet_rule' , 'description' => 'One pet allowed', 'category' => 'pet', 'icon' => 'paw-print'],
            /*Curfew Rule*/
            ['title' => 'curfew_10pm','name' => 'curfew_rule' , 'description' => 'Curfew at 10pm', 'category' => 'curfew', 'icon' => 'clock-alert'],
            ['title' => 'no_curfew', 'name' => 'curfew_rule' , 'description' => 'No curfew', 'category' => 'curfew', 'icon' => 'clock-check'],
            /*Smoking Rule*/
            ['title' => 'no_smoking', 'name' => 'smoking_rule' , 'description' => 'No smoking', 'category' => 'smoking', 'icon' => 'cigarette-off'],
            ['title' => 'smoking_allowed', 'name' => 'smoking_rule' , 'description' => 'Smoking allowed in designated area', 'category' => 'smoking', 'icon' => 'cigarette'],
            /*Guest Rule*/
            ['title' => 'no_guests', 'name' => 'guest_rule' , 'description' => 'No guests allowed', 'category' => 'guest', 'icon' => 'user-round-x'],
            ['title' => 'guest_allowed', 'name' => 'guest_rule' , 'description' => 'Guest allowed with prior notice', 'category' => 'guest', 'icon' => 'users'],
        ];

        foreach ($rules as $rule) {
            Rule::insert([
                'title' => $rule['title'],
                'name' => $rule['name'],
                'description' => $rule['description'],
                'category' => $rule['category'],
                'icon' => $rule['icon'],
            ]);
        }
    }

}
