<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('subscription_packages', function (Blueprint $table) {
            // Add new columns
            $table->enum('gender', ['male', 'female'])->after('contact_limit');
            $table->boolean('is_one_time')->default(true)->after('gender');
        });

        // Make existing columns nullable without requiring doctrine/dbal
        // Use raw SQL for broad compatibility with MySQL
        DB::statement('ALTER TABLE subscription_packages MODIFY duration INT NULL');
        DB::statement('ALTER TABLE subscription_packages MODIFY contact_limit INT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert nullable changes and remove added columns
        // First drop the added columns
        Schema::table('subscription_packages', function (Blueprint $table) {
            if (Schema::hasColumn('subscription_packages', 'gender')) {
                $table->dropColumn('gender');
            }
            if (Schema::hasColumn('subscription_packages', 'is_one_time')) {
                $table->dropColumn('is_one_time');
            }
        });

        // Then revert columns to NOT NULL with original defaults
        DB::statement('ALTER TABLE subscription_packages MODIFY duration INT NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE subscription_packages MODIFY contact_limit INT NOT NULL');
    }
};
