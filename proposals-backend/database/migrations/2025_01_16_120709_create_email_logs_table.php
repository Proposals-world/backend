<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_logs', function (Blueprint $table) {
            $table->id('email_log_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade')->nullable();
            $table->string('recipient_email');
            $table->string('subject');
            $table->text('body')->nullable();
            $table->string('status')->default('sent'); // 'sent', 'failed', 'queued'
            $table->text('error_message')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('recipient_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_logs');
    }
}
