<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id('preference_id');
            $table->foreignId('user_id')->unique()->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('preferred_nationality_id')->nullable()->constrained('nationalities', 'nationality_id')->onDelete('restrict');
            $table->foreignId('preferred_origin_id')->nullable()->constrained('origins', 'origin_id')->onDelete('restrict');
            $table->foreignId('preferred_country_id')->nullable()->constrained('countries', 'country_id')->onDelete('restrict');
            $table->foreignId('preferred_city_id')->nullable()->constrained('cities', 'city_id')->onDelete('restrict');
            $table->integer('preferred_age_min')->nullable();
            $table->integer('preferred_age_max')->nullable();
            $table->foreignId('preferred_educational_level_id')->nullable()->constrained('educational_levels', 'level_id')->onDelete('restrict');
            $table->foreignId('preferred_specialization_id')->nullable()->constrained('specializations', 'specialization_id')->onDelete('restrict');
            $table->boolean('preferred_employment_status')->nullable();
            $table->foreignId('preferred_job_title_id')->nullable()->constrained('job_titles', 'job_title_id')->onDelete('restrict');
            $table->foreignId('preferred_financial_status_id')->nullable()->constrained('financial_statuses', 'financial_status_id')->onDelete('restrict');
            $table->foreignId('preferred_height_id')->nullable()->constrained('heights', 'height_id')->onDelete('restrict');
            $table->foreignId('preferred_weight_id')->nullable()->constrained('weights', 'weight_id')->onDelete('restrict');
            $table->foreignId('preferred_marital_status_id')->nullable()->constrained('marital_statuses', 'marital_status_id')->onDelete('restrict');
            $table->foreignId('preferred_smoking_status_id')->nullable()->constrained('smoking_statuses', 'smoking_status_id')->onDelete('restrict');
            $table->foreignId('preferred_drinking_status_id')->nullable()->constrained('drinking_statuses', 'drinking_status_id')->onDelete('restrict');
            $table->foreignId('preferred_sports_activity_id')->nullable()->constrained('sports_activities', 'sports_activity_id')->onDelete('restrict');
            $table->foreignId('preferred_social_media_presence_id')->nullable()->constrained('social_media_presences', 'social_media_presence_id')->onDelete('restrict');
            $table->foreignId('marriage_budget_id')->nullable()->constrained('marriage_budgets', 'marriage_budget_id')->onDelete('restrict');
            $table->text('must_have_criteria_en')->nullable();
            $table->text('must_have_criteria_ar')->nullable();
            $table->text('extra_features_en')->nullable();
            $table->text('extra_features_ar')->nullable();
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
}
