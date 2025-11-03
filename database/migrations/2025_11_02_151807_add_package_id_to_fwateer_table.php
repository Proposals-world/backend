<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fwateer', function (Blueprint $table) {
            // Add after user_id for logical order
            $table->foreignId('package_id')
                ->nullable()
                ->after('user_id')
                ->constrained('subscription_packages')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('fwateer', function (Blueprint $table) {
            $table->dropForeign(['package_id']);
            $table->dropColumn('package_id');
        });
    }
};
