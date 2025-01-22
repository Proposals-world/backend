<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_feedbacks', function (Blueprint $table) {
            $table->id('feedback_id');
            $table->foreignId('user_id')->nullable()->constrained('users', 'user_id')->onDelete('set null');
            $table->foreignId('match_id')->nullable()->constrained('matches', 'match_id')->onDelete('set null');
            $table->text('feedback')->nullable();
            $table->integer('rating')->nullable(); // e.g., 1 to 5
            $table->timestamps();

            $table->index('user_id');
            $table->index('match_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_feedbacks');
    }
}
