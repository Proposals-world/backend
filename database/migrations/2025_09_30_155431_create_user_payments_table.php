<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained('subscription_packages')->onDelete('cascade'); // ✅ link to subscription_packages

            $table->string('email');
            $table->decimal('amount', 10, 2);
            $table->dateTime('date');
            $table->enum('status', ['pending', 'paid', 'failed', "false_info"])->default('pending'); // payment/subscription status
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_payments');
    }
};
