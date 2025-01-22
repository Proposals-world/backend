<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id('match_id');
            $table->foreignId('user1_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('user2_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('match_gender'); // 'male_female', 'female_male'
            $table->integer('match_percentage')->nullable();
            $table->string('match_status')->default('pending'); // 'pending', 'accepted', 'rejected'
            $table->boolean('contact_exchanged')->default(false);
            $table->timestamps();

            $table->unique(['user1_id', 'user2_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
}
