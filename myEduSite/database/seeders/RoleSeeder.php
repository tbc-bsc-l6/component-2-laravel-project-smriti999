<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
       DB::table('user_roles')->insert([
            ['role' => 'Admin'],
            ['role' => 'Teacher'],
            ['role' => 'Student'],
            ['role' => 'Old Student'],
        ]);
    }
}
