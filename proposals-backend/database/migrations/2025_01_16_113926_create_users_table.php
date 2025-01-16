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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('username')->unique()->after('id');
            $table->string('phone_number')->unique()->after('email');
            $table->string('password_hash')->after('phone_number');
            $table->string('profile_status')->default('active')->after('password_hash'); // 'active', 'inactive', 'engaged', 'suspended'
            $table->string('gender')->after('profile_status'); // 'male', 'female'
            $table->timestamp('last_active')->nullable()->after('created_at');
            $table->string('status')->default('active')->after('last_active'); // 'active', 'not active'
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
