<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'Admin',
            'Teacher',
            'Student',
            'OldStudent',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
            ]);
        }
    }
}
