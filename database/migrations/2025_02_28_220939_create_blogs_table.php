<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('slug')->unique();
            $table->longText('content_ar'); // Blog content
            $table->longText('content_en'); // Blog content
            $table->string('image')->nullable(); // Featured image
            $table->integer('views')->default(0);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('seo_title_ar')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('blogs');
    }
};