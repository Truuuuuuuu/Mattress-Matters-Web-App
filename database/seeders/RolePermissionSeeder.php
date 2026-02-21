<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[(PermissionRegistrar::class)]->forgetCachedPermissions();

        $permissions = [
            'create listings',
            'edit own listings',
            'edit all listings',
            'delete own listings',
            'delete listings',
            'manage users',
            'view all listings',
            'view own listings',
            'manage users',
            'create reservations',
            'view own reservations',
            'cancel own reservations',
        ];

        foreach ($permissions as $permission){
            Permission::firstOrCreate(['name' => $permission]);
        }

        //create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'delete listings',
            'manage users',
            'view all listings',
        ]);

        $hostRole = Role::firstOrCreate(['name' => 'host']);
        $hostRole->givePermissionTo([
            'create listings',
            'edit own listings',
            'delete own listings',
            'view own listings'
        ]);

        $tenantRole = Role::firstOrCreate(['name' => 'tenant']);
        $tenantRole->givePermissionTo([
           'create reservations',
           'view own reservations',
           'cancel own reservations'
        ]);
    }
}
