<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminRoleId = DB::table('user_roles')->where('role', 'admin')->value('id');

        if (!$adminRoleId) {
            $this->command->info('Admin role not found! Please run UserRoleSeeder first.');
            return;
        }

        DB::table('users')->updateOrInsert(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'user_role_id' => $adminRoleId,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $this->command->info("Admin user created or updated: admin@gmail.com / password");
    }
}
