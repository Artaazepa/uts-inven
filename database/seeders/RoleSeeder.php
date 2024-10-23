<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = collect([
            ['name' => 'Administrator'],
            ['name' => 'Staff TU (Tata Usaha)']
        ]);

        $roles->each(function ($role) {
            Role::updateOrCreate(
                ['name' => $role['name'], 'guard_name' => 'web'],  // Search for role by name and guard_name
                ['created_at' => now(), 'updated_at' => now()]      // Update or create if not exists
            );
        });
    }
}
