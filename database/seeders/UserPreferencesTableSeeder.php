<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPreferencesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_preferences')->insert([
            [
                'user_id' => 1, // Admin
                'preferred_nationality_id' => 2, // Egyptian
                // 'preferred_origin_id' => 1, // Middle Eastern
                'preferred_country_id' => 2, // Egypt
                'preferred_city_id' => 2, // Cairo
                'preferred_age_min' => 25,
                'preferred_age_max' => 35,
                'preferred_educational_level_id' => 2, // Bachelor\'s Degree
                'preferred_specialization_id' => 2, // Engineering
                'preferred_employment_status' => true,
                'preferred_job_title_id' => 2, // Data Analyst
                'preferred_financial_status_id' => 1, // Stable
                'preferred_height_id' => 3, // 170 cm
                'preferred_weight_id' => 3, // 70 kg
                'preferred_marital_status_id' => 1, // Single
                'preferred_smoking_status' => 0, // Does not smoke
                'preferred_drinking_status_id' => 2, // Does not drink Alcohol
                'preferred_sports_activity_id' => 1, // Football
                'preferred_social_media_presence_id' => 1, // Instagram
                'marriage_budget_id' => 2, // 10000-20000
                'must_have_criteria_en' => 'Must be honest and kind.',
                'must_have_criteria_ar' => 'يجب أن يكون صادقًا ولطيفًا.',
                'extra_features_en' => 'Preferably with a good sense of humor.',
                'extra_features_ar' => 'يفضل أن يكون لديه حس فكاهي جيد.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // User1
                'preferred_nationality_id' => 1, // Jordanian
                // 'preferred_origin_id' => 1, // Middle Eastern
                'preferred_country_id' => 1, // Jordan
                'preferred_city_id' => 1, // Amman
                'preferred_age_min' => 20,
                'preferred_age_max' => 30,
                'preferred_educational_level_id' => 1, // High School
                'preferred_specialization_id' => null, // Any
                'preferred_employment_status' => true,
                'preferred_job_title_id' => 1, // Software Engineer
                'preferred_financial_status_id' => 2, // Needs Improvement
                'preferred_height_id' => 2, // 160 cm
                'preferred_weight_id' => 2, // 60 kg
                'preferred_marital_status_id' => 1, // Single
                'preferred_smoking_status' => 1, // Smokes
                'preferred_drinking_status_id' => 3, // Occasionally drinks Alcohol
                'preferred_sports_activity_id' => 2, // Swimming
                'preferred_social_media_presence_id' => 2, // Facebook
                'marriage_budget_id' => 1, // 5000-10000
                'must_have_criteria_en' => 'Must love pets.',
                'must_have_criteria_ar' => 'يجب أن يحب الحيوانات الأليفة.',
                'extra_features_en' => 'Enjoys outdoor activities.',
                'extra_features_ar' => 'يستمتع بالأنشطة الخارجية.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, // User2
                'preferred_nationality_id' => 3, // Lebanese
                // 'preferred_origin_id' => 1, // Middle Eastern
                'preferred_country_id' => 3, // Lebanon
                'preferred_city_id' => 3, // Beirut
                'preferred_age_min' => 22,
                'preferred_age_max' => 32,
                'preferred_educational_level_id' => 3, // Master\'s Degree
                'preferred_specialization_id' => 3, // Business Administration
                'preferred_employment_status' => true,
                'preferred_job_title_id' => 3, // Project Manager
                'preferred_financial_status_id' => 1, // Stable
                'preferred_height_id' => 4, // 180 cm
                'preferred_weight_id' => 4, // 80 kg
                'preferred_marital_status_id' => 2, // Married
                'preferred_smoking_status' => 0, // Does not smoke
                'preferred_drinking_status_id' => 2, // Does not drink Alcohol
                'preferred_sports_activity_id' => 3, // Basketball
                'preferred_social_media_presence_id' => 1, // Twitter
                'marriage_budget_id' => 3, // 20000-30000
                'must_have_criteria_en' => 'Must be career-oriented.',
                'must_have_criteria_ar' => 'يجب أن يكون موجهًا نحو المهنة.',
                'extra_features_en' => 'Prefers someone who enjoys traveling.',
                'extra_features_ar' => 'يفضل شخصًا يستمتع بالسفر.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4, // User3
                'preferred_nationality_id' => 4, // Syrian
                // 'preferred_origin_id' => 1, // Middle Eastern
                'preferred_country_id' => 4, // Syria
                'preferred_city_id' => 4, // Damascus
                'preferred_age_min' => 24,
                'preferred_age_max' => 34,
                'preferred_educational_level_id' => 2, // Bachelor\'s Degree
                'preferred_specialization_id' => 3, // Business Administration
                'preferred_employment_status' => true,
                'preferred_job_title_id' => 5, // Business Analyst
                'preferred_financial_status_id' => 1, // Stable
                'preferred_height_id' => 3, // 170 cm
                'preferred_weight_id' => 5, // 90 kg
                'preferred_marital_status_id' => 1, // Single
                'preferred_smoking_status' => 0, // Does not smoke
                'preferred_drinking_status_id' => 2, // Does not drink Alcohol
                'preferred_sports_activity_id' => 4, // Tennis
                'preferred_social_media_presence_id' => 2, // LinkedIn
                'marriage_budget_id' => 4, // 30000+
                'must_have_criteria_en' => 'Must be financially stable.',
                'must_have_criteria_ar' => 'يجب أن يكون مستقرًا ماليًا.',
                'extra_features_en' => 'Loves cooking and baking.',
                'extra_features_ar' => 'يحب الطهي والخبز.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5, // User4
                'preferred_nationality_id' => 5, // Palestinian
                // 'preferred_origin_id' => 1, // Middle Eastern
                'preferred_country_id' => 5, // Palestine
                'preferred_city_id' => 5, // Ramallah
                'preferred_age_min' => 23,
                'preferred_age_max' => 33,
                'preferred_educational_level_id' => 1, // High School
                'preferred_specialization_id' => null, // Any
                'preferred_employment_status' => false,
                'preferred_job_title_id' => null, // Any
                'preferred_financial_status_id' => 4, // Poor
                'preferred_height_id' => 1, // 150 cm
                'preferred_weight_id' => 1, // 50 kg
                'preferred_marital_status_id' => 1, // Single
                'preferred_smoking_status' => 1, // Smokes
                'preferred_drinking_status_id' => 4, // Prefers not to say
                'preferred_sports_activity_id' => 5, // Running
                'preferred_social_media_presence_id' => 1, // Other
                'marriage_budget_id' => 1, // 5000-10000
                'must_have_criteria_en' => 'Must enjoy cooking.',
                'must_have_criteria_ar' => 'يجب أن يستمتع بالطهي.',
                'extra_features_en' => 'Prefers someone who is understanding.',
                'extra_features_ar' => 'يفضل شخصًا متفهمًا.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}