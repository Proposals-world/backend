<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content'); // Blog content
            $table->string('image')->nullable(); // Featured image
            $table->integer('views')->default(0);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('blogs');
    }
};