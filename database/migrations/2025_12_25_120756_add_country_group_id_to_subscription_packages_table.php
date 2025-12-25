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
        Schema::table('subscription_packages', function (Blueprint $table) {
            $table->foreignId('country_group_id')->nullable()->constrained('country_groups');
            $table->boolean('is_default')->default(false);
            $table->boolean('is_special_offer')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_packages', function (Blueprint $table) {
            $table->dropForeign(['country_group_id']);
            $table->dropColumn('country_group_id');
            $table->dropColumn('is_default');
            $table->dropColumn('is_special_offer');
        });
    }
};
