<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@site.com',
            'password' => Hash::make('password'),
        ]);

        $role = Role::where('name', 'Admin')->first();

        if ($role) {
            $admin->roles()->attach($role->id);
        }
    }
}