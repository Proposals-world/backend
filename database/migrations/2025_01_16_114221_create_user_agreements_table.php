<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_agreements', function (Blueprint $table) {
            $table->id('agreement_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('agreement_type'); // e.g., 'terms_of_service', 'privacy_policy'
            $table->string('agreement_version')->nullable(); // To track versions
            $table->timestamp('agreed_at')->useCurrent();
            $table->timestamps();

            // Optional: Add an index for faster queries on agreement_type
            $table->index('agreement_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_agreements');
    }
}
