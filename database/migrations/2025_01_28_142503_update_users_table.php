<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the old 'name' column
            $table->dropColumn('name');

            // Add the new 'first_name' and 'last_name' columns
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the 'name' column back
            $table->string('name')->after('id');

            // Drop the 'first_name' and 'last_name' columns
            $table->dropColumn(['first_name', 'last_name']);
        });
    }
}