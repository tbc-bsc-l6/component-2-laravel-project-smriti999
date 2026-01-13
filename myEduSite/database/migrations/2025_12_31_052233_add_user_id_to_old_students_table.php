<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('old_students', function (Blueprint $table) {
            // Only add the column if it doesn't exist
            if (!Schema::hasColumn('old_students', 'user_id')) {
                $table->unsignedBigInteger('user_id')->unique()->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            });
    }

    public function down(): void {
        Schema::table('old_students', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
