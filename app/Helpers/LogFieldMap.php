<?php

namespace App\Helpers;

class LogFieldMap
{
    public static function labels()
    {
        return [
            // General Info
            'nickname' => 'Nickname',
            'bio_en' => 'Biography (EN)',
            'bio_ar' => 'Biography (AR)',
            'avatar_url' => 'Profile Picture',
            'id_number' => 'ID Number',
            'language_id' => 'Preferred Language',

            // Verification
            'id_verification_status' => 'ID Verification Status',
            'criminal_record_status' => 'Criminal Record Verification Status',
            'criminal_record_url' => 'Criminal Record File',

            // Location
            'city_location_id' => 'City Location',
            'city_id' => 'City',
            'country_of_residence_id' => 'Country of Residence',
            'nationality_id' => 'Nationality',
            'origin_id' => 'Origin',
            'zodiac_sign_id' => 'Zodiac Sign',

            // Education & Work
            'educational_level_id' => 'Education Level',
            'specialization_id' => 'Specialization',
            'employment_status' => 'Employment Status',
            'job_title_id' => 'Job Title',
            'sector_id' => 'Job Sector',
            'position_level_id' => 'Position Level',
            'financial_status_id' => 'Financial Status',

            // Housing
            'housing_id' => 'Housing Status',
            'car_ownership' => 'Car Ownership',

            // Physical
            'height_id' => 'Height',
            'weight_id' => 'Weight',
            'skin_color_id' => 'Skin Color',
            'hair_color_id' => 'Hair Color',
            'eye_color_id' => 'Eye Color',

            // Health
            'health_issues_en' => 'Health Issues (EN)',
            'health_issues_ar' => 'Health Issues (AR)',

            // Family & Lifestyle
            'marital_status_id' => 'Marital Status',
            'children' => 'Number of Children',
            'hijab_status' => 'Hijab Status',
            'smoking_status' => 'Smoking Status',
            'drinking_status_id' => 'Drinking Status',
            'sports_activity_id' => 'Sports Activity',
            'social_media_presence_id' => 'Social Media Presence',
            'sleep_habit_id' => 'Sleep Habit',
            'religiosity_level_id' => 'Religiosity Level',
            'marriage_budget_id' => 'Marriage Budget',

            // Guardian
            'guardian_contact_encrypted' => 'Guardian Contact',

            // In LogFieldMap::labels()
            'hobbies' => 'Hobbies',
            'pets' => 'Pets',
            'smoking_tools' => 'Smoking Tools',

        ];
    }
}
