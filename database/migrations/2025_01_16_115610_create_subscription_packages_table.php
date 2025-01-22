<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPackagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_packages', function (Blueprint $table) {
            $table->id('package_id');
            $table->string('package_name_en')->unique();
            $table->string('package_name_ar')->unique();
            $table->text('features_en')->nullable(); // Comma-separated or JSON
            $table->text('features_ar')->nullable(); // Comma-separated or JSON
            $table->decimal('price', 8, 2);
            $table->integer('duration_days');
            $table->integer('contact_limit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_packages');
    }
}
