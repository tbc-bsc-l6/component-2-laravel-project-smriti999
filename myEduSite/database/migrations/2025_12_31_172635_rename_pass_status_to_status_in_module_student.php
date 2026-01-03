<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            ALTER TABLE module_student 
            CHANGE COLUMN pass_status status ENUM('passed','failed','pending') NOT NULL DEFAULT 'pending'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE module_student 
            CHANGE COLUMN status pass_status ENUM('passed','failed','pending') NOT NULL DEFAULT 'pending'
        ");
    }
};
