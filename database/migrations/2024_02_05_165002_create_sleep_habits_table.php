<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sleep_habits', function (Blueprint $table) {
            $table->id();
            $table->string('name_en'); // English name, e.g., "Morning"
            $table->string('name_ar'); // Arabic name, e.g., "صباحي"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sleep_habits');
    }
};