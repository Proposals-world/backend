<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_preference_smoking_tool', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_preference_id')->constrained('user_preferences')->onDelete('cascade');
            $table->foreignId('smoking_tool_id')->constrained('smoking_tools')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_preference_id', 'smoking_tool_id'], 'user_pref_smoke_tool_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_preference_smoking_tool');
    }
};
