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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('username')->unique();
            $table->string('phone_number')->unique();
            $table->string('password_hash');
            $table->string('profile_status')->default('active'); // 'active', 'inactive', 'engaged', 'suspended'
            $table->string('gender'); // 'male', 'female'
            $table->timestamp('last_active')->nullable();
            $table->string('status')->default('active'); // 'active', 'not active'
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
