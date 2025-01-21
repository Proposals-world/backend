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
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users', 'user_id')->onDelete('cascade');
            $table->text('bio_en')->nullable();
            $table->text('bio_ar')->nullable();
            $table->string('avatar_url')->nullable();
            $table->string('id_number')->nullable();
            $table->string('criminal_record_url')->nullable();
            $table->string('id_verification_status')->default('unverified'); // 'unverified', 'pending', 'verified', 'rejected'
            $table->string('criminal_record_status')->default('unverified'); // 'unverified', 'pending', 'verified', 'rejected'
            $table->foreignId('nationality_id')->constrained('nationalities', 'nationality_id')->onDelete('restrict');
            $table->foreignId('origin_id')->nullable()->constrained('origins', 'origin_id')->onDelete('restrict'); // If Jordanian
            $table->foreignId('religion_id')->constrained('religions', 'religion_id')->onDelete('restrict');
            $table->foreignId('country_of_residence_id')->constrained('countries', 'country_id')->onDelete('restrict');
            $table->foreignId('city_id')->constrained('cities', 'city_id')->onDelete('restrict');
            $table->string('area')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable(); // Calculated from date_of_birth
            $table->foreignId('zodiac_sign_id')->nullable()->constrained('zodiac_signs', 'zodiac_sign_id')->onDelete('restrict');
            $table->foreignId('educational_level_id')->constrained('educational_levels', 'level_id')->onDelete('restrict');
            $table->foreignId('specialization_id')->nullable()->constrained('specializations', 'specialization_id')->onDelete('restrict');
            $table->boolean('employment_status')->default(false); // true for 'Yes', false for 'No'
            $table->foreignId('job_title_id')->nullable()->constrained('job_titles', 'job_title_id')->onDelete('restrict');
            $table->foreignId('sector_id')->nullable()->constrained('sectors', 'sector_id')->onDelete('restrict');
            $table->foreignId('position_level_id')->nullable()->constrained('position_levels', 'position_level_id')->onDelete('restrict');
            $table->foreignId('financial_status_id')->nullable()->constrained('financial_statuses', 'financial_status_id')->onDelete('restrict');
            $table->foreignId('housing_id')->nullable()->constrained('housing_statuses', 'housing_status_id')->onDelete('restrict'); // For males
            $table->boolean('car_ownership')->default(false); // true for 'Own', false for 'Don't own'
            $table->foreignId('height_id')->nullable()->constrained('heights', 'height_id')->onDelete('restrict');
            $table->foreignId('weight_id')->nullable()->constrained('weights', 'weight_id')->onDelete('restrict');
            $table->text('health_issues_en')->nullable();
            $table->text('health_issues_ar')->nullable();
            $table->foreignId('marital_status_id')->constrained('marital_statuses', 'marital_status_id')->onDelete('restrict');
            $table->integer('children')->default(0); // Number of children, if any
            $table->foreignId('skin_color_id')->nullable()->constrained('skin_colors', 'skin_color_id')->onDelete('restrict');
            $table->foreignId('hair_color_id')->nullable()->constrained('hair_colors', 'hair_color_id')->onDelete('restrict');
            $table->foreignId('hijab_status_id')->nullable()->constrained('hijab_statuses', 'hijab_status_id')->onDelete('restrict'); // For females
            $table->foreignId('smoking_status_id')->nullable()->constrained('smoking_statuses', 'smoking_status_id')->onDelete('restrict');
            $table->foreignId('drinking_status_id')->nullable()->constrained('drinking_statuses', 'drinking_status_id')->onDelete('restrict');
            $table->foreignId('sports_activity_id')->nullable()->constrained('sports_activities', 'sports_activity_id')->onDelete('restrict');
            $table->foreignId('social_media_presence_id')->nullable()->constrained('social_media_presences', 'social_media_presence_id')->onDelete('restrict');
            $table->text('guardian_contact_en')->nullable(); // For females
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
