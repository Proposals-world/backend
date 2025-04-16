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
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->unique();
            $table->foreignId('preferred_nationality_id')->nullable()->constrained('nationalities');
            $table->foreignId('preferred_language_id')->nullable()->constrained('languages');

            $table->foreignId('preferred_origin_id')->nullable()->constrained('origins');
            $table->foreignId('preferred_country_id')->nullable()->constrained('countries');
            $table->foreignId('preferred_city_id')->nullable()->constrained('cities');
            $table->integer('preferred_age_min')->nullable();
            $table->integer('preferred_age_max')->nullable();
            $table->foreignId('preferred_educational_level_id')->nullable()->constrained('educational_levels');
            $table->foreignId('preferred_specialization_id')->nullable()->constrained('specializations');
            $table->boolean('preferred_employment_status')->nullable();
            $table->foreignId('preferred_job_title_id')->nullable()->constrained('job_titles');
            $table->foreignId('preferred_financial_status_id')->nullable()->constrained('financial_statuses');
            $table->foreignId('preferred_height_id')->nullable()->constrained('heights');
            $table->foreignId('preferred_weight_id')->nullable()->constrained('weights');
            $table->foreignId('preferred_marital_status_id')->nullable()->constrained('marital_statuses');
            $table->boolean('preferred_smoking_status')->nullable();
            $table->foreignId('preferred_drinking_status_id')->nullable()->constrained('drinking_statuses');
            $table->foreignId('preferred_sports_activity_id')->nullable()->constrained('sports_activities');
            $table->foreignId('preferred_social_media_presence_id')->nullable()->constrained('social_media_presences');
            $table->foreignId('preferred_religiosity_level_id')->nullable()->constrained('religiosity_levels');
            $table->foreignId('preferred_sleep_habit_id')->nullable()->constrained('sleep_habits');
            $table->foreignId('preferred_marriage_budget_id')->nullable()->constrained('marriage_budgets');
            // Added new columns
            $table->foreignId('preferred_skin_color_id')->nullable()->constrained('skin_colors'); // New skin color
            $table->foreignId('preferred_hair_color_id')->nullable()->constrained('hair_colors'); // New hair color
            $table->boolean('preferred_hijab_status')->nullable(); // New hijab status
            $table->integer('preferred_children_count')->nullable(); // New children count
            $table->boolean('preferred_car_ownership')->nullable(); // New car ownership
            $table->foreignId('preferred_housing_status_id')->nullable()->constrained('housing_statuses'); // New housing status

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
