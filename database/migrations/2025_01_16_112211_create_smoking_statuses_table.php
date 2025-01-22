<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmokingStatusesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('smoking_statuses', function (Blueprint $table) {
            $table->id('smoking_status_id');
            $table->foreignId('smoking_detail_id')->constrained('smoking_details', 'smoking_detail_id')->onDelete('cascade');
            $table->tinyInteger('status'); // Assuming 'status' is an integer field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smoking_statuses');
    }
}
