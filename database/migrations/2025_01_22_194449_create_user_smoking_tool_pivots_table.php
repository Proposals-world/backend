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
        Schema::create('user_smoking_tool_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_id')->constrained('smoking_tools');
            $table->foreignId('user_profile_id')->constrained('user_profiles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_smoking_tool_pivots');
    }
};
