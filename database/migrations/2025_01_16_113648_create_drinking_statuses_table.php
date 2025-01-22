<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrinkingStatusesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drinking_statuses', function (Blueprint $table) {
            $table->id('drinking_status_id');
            $table->string('name_en')->unique(); // e.g., 'No Preference', 'No', 'Sometimes', 'Yes'
            $table->string('name_ar')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drinking_statuses');
    }
}
