<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReportsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_reports', function (Blueprint $table) {
            $table->id('report_id');
            $table->foreignId('reporter_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('reported_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->text('reason_en');
            $table->text('reason_ar');
            $table->string('status')->default('pending'); // 'pending', 'reviewed', 'action_taken'
            $table->integer('report_count')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_reports');
    }
}
