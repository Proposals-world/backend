<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            // Add Position Level
            $table->foreignId('preferred_position_level_id')
                ->nullable()
                ->constrained('position_levels')
                ->after('preferred_specialization_id');
        });
    }

    public function down(): void
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            $table->dropForeign(['preferred_position_level_id']);
            $table->dropColumn('preferred_position_level_id');
        });
    }
};
