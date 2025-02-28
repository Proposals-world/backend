<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('city_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->string('name_en');
            $table->string('name_ar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('city_locations');
    }
};