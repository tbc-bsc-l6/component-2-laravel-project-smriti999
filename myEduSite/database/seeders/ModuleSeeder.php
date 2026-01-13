<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        Module::insert([
            ['name' => 'Math 101', 'description' => 'Basic Math'],
            ['name' => 'Physics 101', 'description' => 'Introduction to Physics'],
            ['name' => 'Chemistry 101', 'description' => 'Basics of Chemistry'],
        ]);
    }
}
