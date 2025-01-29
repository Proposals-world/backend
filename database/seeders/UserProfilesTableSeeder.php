<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfilesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_profiles')->insert([
            [
                'id' => 1, // Admin Profile
                'bio_en' => 'Administrator of the platform.',
                'bio_ar' => 'مدير المنصة.',
                'nationality_id' => 1, // Jordanian
                'religion_id' => 1, // Islam
                'country_of_residence_id' => 1, // Jordan
                'city_id' => 1, // Amman
                'date_of_birth' => '1990-01-01',
                'age' => 33,
                'educational_level_id' => 2, // Bachelor's Degree
                'specialization_id' => 1, // Computer Science
                'employment_status' => true,
                'job_title_id' => 1, // Software Engineer
                'sector_id' => 1, // IT
                'position_level_id' => 3, // Senior Level
                'financial_status_id' => 1, // Stable
                'housing_id' => 1, // Owned
                'car_ownership' => true,
                'height_id' => 3, // 170 cm
                'weight_id' => 3, // 70 kg
                'health_issues_en' => null,
                'health_issues_ar' => null,
                'marital_status_id' => 1, // Single
                'children' => 0,
                'skin_color_id' => 2, // Medium
                'hair_color_id' => 1, // Black
                'hijab_status_id' => 2, // Does not wear Hijab
                'smoking_status_id' => 2, // Does not smoke
                'drinking_status_id' => 2, // Does not drink Alcohol
                'sports_activity_id' => 1, // Football
                'social_media_presence_id' => 1, // Instagram
                'guardian_contact_encrypted' => null,
                'avatar_url' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
                'id_number' => 'A123456789',
                'criminal_record_url' => null,
                'id_verification_status' => 'verified',
                'criminal_record_status' => 'unverified',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2, // User1 Profile
                'bio_en' => 'User 1 is an active member.',
                'bio_ar' => 'المستخدم 1 عضو نشط.',
                'nationality_id' => 2, // Egyptian
                'religion_id' => 1, // Islam
                // 'origin_id' => 2, // Removed to fix the issue
                'country_of_residence_id' => 2, // Egypt
                'city_id' => 2, // Cairo
                'date_of_birth' => '1995-02-15',
                'age' => 28,
                'educational_level_id' => 3, // Master's Degree
                'specialization_id' => 2, // Engineering
                'employment_status' => true,
                'job_title_id' => 2, // Data Analyst
                'sector_id' => 3, // Finance
                'position_level_id' => 2, // Mid Level
                'financial_status_id' => 2, // Needs Improvement
                'housing_id' => 2, // Rented
                'car_ownership' => false,
                'height_id' => 2, // 160 cm
                'weight_id' => 2, // 60 kg
                'health_issues_en' => null,
                'health_issues_ar' => null,
                'marital_status_id' => 1, // Single
                'children' => 0,
                'skin_color_id' => 1, // Fair
                'hair_color_id' => 2, // Brown
                'hijab_status_id' => 1, // Wears Hijab
                'smoking_status_id' => 1, // Smokes
                'drinking_status_id' => 3, // Occasionally drinks Alcohol
                'sports_activity_id' => 2, // Swimming
                'social_media_presence_id' => 2, // Facebook
                'guardian_contact_encrypted' => null,
                'avatar_url' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
                'id_number' => 'E987654321',
                'criminal_record_url' => null,
                'id_verification_status' => 'verified',
                'criminal_record_status' => 'unverified',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3, // User2 Profile
                'bio_en' => 'User 2 enjoys outdoor activities.',
                'bio_ar' => 'المستخدم 2 يستمتع بالأنشطة الخارجية.',
                'nationality_id' => 1, // Jordanian
                'religion_id' => 2, // Christianity
                // 'origin_id' => 1, // Removed to fix the issue
                'country_of_residence_id' => 1, // Jordan
                'city_id' => 3, // Beirut
                'date_of_birth' => '1992-05-10',
                'age' => 31,
                'educational_level_id' => 2, // Bachelor's Degree
                'specialization_id' => 3, // Business Administration
                'employment_status' => true,
                'job_title_id' => 3, // Project Manager
                'sector_id' => 4, // Education
                'position_level_id' => 3, // Senior Level
                'financial_status_id' => 1, // Stable
                'housing_id' => 1, // Owned
                'car_ownership' => true,
                'height_id' => 4, // 180 cm
                'weight_id' => 3, // 70 kg
                'health_issues_en' => null,
                'health_issues_ar' => null,
                'marital_status_id' => 2, // Married
                'children' => 2,
                'skin_color_id' => 2, // Medium
                'hair_color_id' => 1, // Black
                'hijab_status_id' => 2, // Does not wear Hijab
                'smoking_status_id' => 2, // Does not smoke
                'drinking_status_id' => 2, // Does not drink Alcohol
                'sports_activity_id' => 3, // Basketball
                'social_media_presence_id' => 3, // Twitter
                'guardian_contact_encrypted' => null,
                'avatar_url' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
                'id_number' => 'J112233445',
                'criminal_record_url' => null,
                'id_verification_status' => 'verified',
                'criminal_record_status' => 'unverified',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4, // User3 Profile
                'bio_en' => 'User 3 loves photography.',
                'bio_ar' => 'المستخدم 3 يحب التصوير الفوتوغرافي.',
                'nationality_id' => 3, // Lebanese
                'religion_id' => 1, // Islam
                // 'origin_id' => 1, // Removed to fix the issue
                'country_of_residence_id' => 3, // Lebanon
                'city_id' => 4, // Damascus
                'date_of_birth' => '1998-08-20',
                'age' => 25,
                'educational_level_id' => 4, // PhD
                'specialization_id' => 4, // Medicine
                'employment_status' => true,
                'job_title_id' => 4, // Doctor
                'sector_id' => 2, // Healthcare
                'position_level_id' => 4, // Manager
                'financial_status_id' => 3, // Excellent
                'housing_id' => 3, // Living with Parents
                'car_ownership' => false,
                'height_id' => 5, // 190 cm
                'weight_id' => 4, // 80 kg
                'health_issues_en' => null,
                'health_issues_ar' => null,
                'marital_status_id' => 1, // Single
                'children' => 0,
                'skin_color_id' => 1, // Fair
                'hair_color_id' => 3, // Blonde
                'hijab_status_id' => 1, // Wears Hijab
                'smoking_status_id' => 1, // Smokes
                'drinking_status_id' => 1, // Drinks Alcohol
                'sports_activity_id' => 3, // Basketball
                'social_media_presence_id' => 4, // LinkedIn
                'guardian_contact_encrypted' => null,
                'avatar_url' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
                'id_number' => 'L556677889',
                'criminal_record_url' => null,
                'id_verification_status' => 'verified',
                'criminal_record_status' => 'unverified',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5, // User4 Profile
                'bio_en' => 'User 4 is a software developer.',
                'bio_ar' => 'المستخدم 4 مطور برامج.',
                'nationality_id' => 4, // Syrian
                'religion_id' => 2, // Christianity
                // 'origin_id' => 1, // Removed to fix the issue
                'country_of_residence_id' => 4, // Syria
                'city_id' => 5, // Ramallah
                'date_of_birth' => '1993-03-25',
                'age' => 30,
                'educational_level_id' => 2, // Bachelor's Degree
                'specialization_id' => 3, // Business Administration
                'employment_status' => true,
                'job_title_id' => 5, // Business Analyst
                'sector_id' => 1, // IT
                'position_level_id' => 2, // Mid Level
                'financial_status_id' => 1, // Stable
                'housing_id' => 1, // Owned
                'car_ownership' => true,
                'height_id' => 3, // 170 cm
                'weight_id' => 5, // 90 kg
                'health_issues_en' => null,
                'health_issues_ar' => null,
                'marital_status_id' => 2, // Married
                'children' => 1,
                'skin_color_id' => 3, // Dark
                'hair_color_id' => 2, // Brown
                'hijab_status_id' => 2, // Does not wear Hijab
                'smoking_status_id' => 2, // Does not smoke
                'drinking_status_id' => 2, // Does not drink Alcohol
                'sports_activity_id' => 4, // Tennis
                'social_media_presence_id' => 5, // Snapchat
                'guardian_contact_encrypted' => null,
                'avatar_url' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
                'id_number' => 'S998877665',
                'criminal_record_url' => null,
                'id_verification_status' => 'verified',
                'criminal_record_status' => 'unverified',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6, // User5 Profile
                'bio_en' => 'User 5 enjoys cooking.',
                'bio_ar' => 'المستخدم 5 يستمتع بالطهي.',
                'nationality_id' => 5, // Palestinian
                'religion_id' => 1, // Islam
                // 'origin_id' => 1, // Removed to fix the issue
                'country_of_residence_id' => 5, // Palestine
                'city_id' => 6, // Zarqa
                'date_of_birth' => '1997-12-01',
                'age' => 26,
                'educational_level_id' => 1, // High School
                'specialization_id' => null, // No specialization
                'employment_status' => false,
                'job_title_id' => null, // No job title
                'sector_id' => null, // No sector
                'position_level_id' => null, // No position level
                'financial_status_id' => 4, // Poor
                'housing_id' => 4, // Other
                'car_ownership' => false,
                'height_id' => 1, // 150 cm
                'weight_id' => 1, // 50 kg
                'health_issues_en' => null,
                'health_issues_ar' => null,
                'marital_status_id' => 1, // Single
                'children' => 0,
                'skin_color_id' => 4, // Other
                'hair_color_id' => 4, // Red
                'hijab_status_id' => 3, // Occasionally wears Hijab
                'smoking_status_id' => 1, // Smokes
                'drinking_status_id' => 4, // Prefers not to say
                'sports_activity_id' => 5, // Running
                'social_media_presence_id' => 6, // Other
                'guardian_contact_encrypted' => null,
                'avatar_url' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
                'id_number' => 'P223344556',
                'criminal_record_url' => null,
                'id_verification_status' => 'verified',
                'criminal_record_status' => 'unverified',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}