<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchaseCountToSubscriptionPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_packages', function (Blueprint $table) {
            $table->integer('purchase_count')->default(0)->after('payment_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription_packages', function (Blueprint $table) {
            $table->dropColumn('purchase_count');
        });
    }
}
