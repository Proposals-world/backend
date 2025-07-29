<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    public function run()
    {
        DB::table('features')->insert([
            // Basic Package
            ['name_en' => 'Basic Profile Information', 'name_ar' => 'معلومات الملف الشخصي الأساسية'],
            ['name_en' => 'Employment Status', 'name_ar' => 'حالة التوظيف'],
            ['name_en' => 'Educational Level', 'name_ar' => 'المستوى التعليمي'],
            ['name_en' => 'City and Country of Residence', 'name_ar' => 'المدينة وبلد الإقامة'],

            // Standard Package
            ['name_en' => 'Profile Verification', 'name_ar' => 'التحقق من الحساب'],
            ['name_en' => 'Marital Status & Children', 'name_ar' => 'الحالة الاجتماعية وعدد الأطفال'],
            ['name_en' => 'Financial Status', 'name_ar' => 'الحالة المالية'],
            ['name_en' => 'Physical Attributes', 'name_ar' => 'الصفات الجسدية'],
            ['name_en' => 'Lifestyle Preferences', 'name_ar' => 'تفضيلات نمط الحياة'],

            // Premium Package
            ['name_en' => 'Zodiac Sign', 'name_ar' => 'البرج الفلكي'],
            ['name_en' => 'Health Information', 'name_ar' => 'المعلومات الصحية'],
            ['name_en' => 'Sports Activity Level', 'name_ar' => 'مستوى النشاط الرياضي'],
            ['name_en' => 'Social Media Presence', 'name_ar' => 'الوجود على وسائل التواصل الاجتماعي'],
            ['name_en' => 'Guardian Contact (Encrypted)', 'name_ar' => 'رقم ولية الأمر(مشفّر)'],
            ['name_en' => 'Religiosity Level', 'name_ar' => 'مستوى التدين'],
            ['name_en' => 'Sleep Habits', 'name_ar' => 'عادات النوم'],
            ['name_en' => 'Marriage Budget Expectations', 'name_ar' => 'توقعات ميزانية الزواج'],
        ]);
    }
}
