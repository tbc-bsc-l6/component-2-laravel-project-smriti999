<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->unsignedBigInteger('user_role_id')->nullable()->change();
        // OR to set default
        // $table->unsignedBigInteger('user_role_id')->default(1)->change();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->unsignedBigInteger('user_role_id')->nullable(false)->change();
    });
}

};
