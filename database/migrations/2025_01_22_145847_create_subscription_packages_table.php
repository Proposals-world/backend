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
        Schema::create('subscription_packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name_en');
            $table->string('package_name_ar');
            $table->decimal('price', 10, 2);
            $table->integer('duration')->nullable(); // Duration in days nullable
            $table->integer('contact_limit')->nullable();
            $table->enum('gender', ['male', 'female']); // enum for gender targeting
            $table->boolean('is_one_time')->default(true); // Active status of the package
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
};
