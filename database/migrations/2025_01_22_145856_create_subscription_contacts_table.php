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
        Schema::create('subscription_contacts', function (Blueprint $table) {
            $table->id();

            // cascade when a subscription is deleted
            $table
                ->foreignId('subscription_id')
                ->constrained('subscriptions')
                ->cascadeOnDelete();

            // cascade when a user is deleted
            $table
                ->foreignId('contact_user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamp('accessed_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_contacts');
    }
};
