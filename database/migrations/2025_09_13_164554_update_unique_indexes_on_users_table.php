<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop old unique index on phone_number
            $table->dropUnique('users_phone_number_unique');

            // Create new composite unique index (phone_number + deleted_at)
            $table->unique(['phone_number', 'deleted_at'], 'users_phone_deleted_unique');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop new composite index
            $table->dropUnique('users_phone_deleted_unique');

            // Restore old unique index
            $table->unique('phone_number', 'users_phone_number_unique');
        });
    }
};
