<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscription_packages', function (Blueprint $table) {
            $table->string('fintesa_product_id')->nullable()->after('is_one_time');
            $table->string('fintesa_price_id')->nullable()->after('fintesa_product_id');
            $table->text('payment_url')->nullable()->after('fintesa_price_id');
        });
    }

    public function down(): void
    {
        Schema::table('subscription_packages', function (Blueprint $table) {
            if (Schema::hasColumn('subscription_packages', 'payment_url')) {
                $table->dropColumn('payment_url');
            }
            if (Schema::hasColumn('subscription_packages', 'fintesa_price_id')) {
                $table->dropColumn('fintesa_price_id');
            }
            if (Schema::hasColumn('subscription_packages', 'fintesa_product_id')) {
                $table->dropColumn('fintesa_product_id');
            }
        });
    }
};

