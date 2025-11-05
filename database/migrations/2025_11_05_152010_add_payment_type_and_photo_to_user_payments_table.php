<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_payments', function (Blueprint $table) {
            // Add payment type and photo URL columns
            $table->enum('payment_type', ['cliq', 'visa'])->after('status')->nullable();
            $table->string('photo_url')->after('payment_type')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('user_payments', function (Blueprint $table) {
            $table->dropColumn(['payment_type', 'photo_url']);
        });
    }
};
