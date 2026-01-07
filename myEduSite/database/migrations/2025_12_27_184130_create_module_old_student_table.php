<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('module_old_student', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('old_student_id');
            $table->unsignedBigInteger('module_id');

            $table->enum('status', ['passed', 'failed']);
            $table->timestamp('enrolled_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->unique(['old_student_id', 'module_id']);

            $table->foreign('old_student_id')
                ->references('id')
                ->on('old_students') // ✅ Correct FK
                ->onDelete('cascade');

            $table->foreign('module_id')
                ->references('id')
                ->on('modules')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module_old_student');
    }
};
