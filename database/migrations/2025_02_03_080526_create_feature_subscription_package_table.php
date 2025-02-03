<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureSubscriptionPackageTable extends Migration
{
    public function up()
    {
        Schema::create('feature_subscription_package', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_package_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('feature_id')
                ->constrained()
                ->onDelete('cascade');
            $table->boolean('included')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feature_subscription_package');
    }
}
