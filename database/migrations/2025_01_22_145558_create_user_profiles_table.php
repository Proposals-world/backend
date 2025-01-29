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
        Schema::create('user_profiles', function (Blueprint $table) {
            // Instead of $table->id(), define 'id' as an unsignedBigInteger without auto-increment
            $table->unsignedBigInteger('id')->primary();

            // Set 'id' as a foreign key referencing 'users.id'
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');

            $table->text('bio_en');
            $table->text('bio_ar');
            $table->string('avatar_url')->nullable();
            $table->string('id_number')->nullable();
            $table->string('criminal_record_url')->nullable();
            $table->string('id_verification_status')->default('unverified');
            $table->string('criminal_record_status')->default('unverified');

            $table->foreignId('nationality_id')->constrained('nationalities');
            $table->foreignId('origin_id')->nullable()->constrained('origins');
            $table->foreignId('religion_id')->constrained('religions');
            $table->foreignId('country_of_residence_id')->constrained('countries');
            $table->foreignId('city_id')->constrained('cities');
            $table->date('date_of_birth');
            $table->integer('age')->nullable();
            $table->foreignId('zodiac_sign_id')->nullable()->constrained('zodiac_signs');
            $table->foreignId('educational_level_id')->constrained('educational_levels');
            $table->foreignId('specialization_id')->nullable()->constrained('specializations');
            $table->boolean('employment_status');
            $table->foreignId('job_title_id')->nullable()->constrained('job_titles');
            $table->foreignId('sector_id')->nullable()->constrained('sectors');
            $table->foreignId('position_level_id')->nullable()->constrained('position_levels');
            $table->foreignId('financial_status_id')->nullable()->constrained('financial_statuses');
            $table->foreignId('housing_id')->nullable()->constrained('housing_statuses');
            $table->boolean('car_ownership')->nullable();
            $table->foreignId('height_id')->nullable()->constrained('heights');
            $table->foreignId('weight_id')->nullable()->constrained('weights');
            $table->text('health_issues_en')->nullable();
            $table->text('health_issues_ar')->nullable();
            $table->foreignId('marital_status_id')->constrained('marital_statuses');
            $table->integer('children')->nullable();
            $table->foreignId('skin_color_id')->nullable()->constrained('skin_colors');
            $table->foreignId('hair_color_id')->nullable()->constrained('hair_colors');
            $table->foreignId('hijab_status_id')->nullable()->constrained('hijab_statuses');
            $table->foreignId('smoking_status_id')->nullable()->constrained('smoking_statuses');
            $table->foreignId('drinking_status_id')->nullable()->constrained('drinking_statuses');
            $table->foreignId('sports_activity_id')->nullable()->constrained('sports_activities');
            $table->foreignId('social_media_presence_id')->nullable()->constrained('social_media_presences');
            $table->string('guardian_contact_encrypted')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};