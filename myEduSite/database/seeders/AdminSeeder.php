<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

       User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role_id' => 1 // ADMIN ROLE ID
        ]);
        
    }
}
