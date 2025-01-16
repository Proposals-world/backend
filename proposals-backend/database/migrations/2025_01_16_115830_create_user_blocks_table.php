<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBlocksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_blocks', function (Blueprint $table) {
            $table->id('block_id');
            $table->foreignId('blocker_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('blocked_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->timestamp('block_start_time')->useCurrent();
            $table->timestamp('block_end_time')->nullable(); // Null if indefinite
            $table->text('reason_en')->nullable(); // Reason in English
            $table->text('reason_ar')->nullable(); // Reason in Arabic
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_blocks');
    }
}
