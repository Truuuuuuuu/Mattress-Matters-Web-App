<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            RolePermissionSeeder::class,
        ]);

        //create admin
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com'
        ]);
        $admin->assignRole('admin');

        //create host
        $host = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'doe@gmail.com'
        ]);
        $host->assignRole('host');

        $tenant = User::factory()->create([
           'name' => 'Tru Aguilar',
           'email' => 'tru@gmail.com'
        ]);
        $tenant->assignRole('tenant');

    }
}
