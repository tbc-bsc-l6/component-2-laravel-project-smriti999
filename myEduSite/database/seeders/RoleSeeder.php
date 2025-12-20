<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; // Make sure to import Role

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['name'=>'Admin'],
            ['name'=>'Teacher'],
            ['name'=>'Student'],
            ['name'=>'OldStudent'],
        ]);
    }
}
