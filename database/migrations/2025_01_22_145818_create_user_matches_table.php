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
        Schema::create('user_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user1_id')->constrained('users');
            $table->foreignId('user2_id')->constrained('users');
            // $table->string('match_gender');
            // $table->integer('match_percentage')->nullable();
            $table->string('match_status')->default('pending');
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
        Schema::dropIfExists('user_matches');
    }
};
