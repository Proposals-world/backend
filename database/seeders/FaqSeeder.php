<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run()
    {
        Faq::insert([
            [
                'question_en' => 'How can I submit a tender request for Islamic marriage services?',
                'question_ar' => 'كيف يمكنني تقديم طلب عطاء لخدمات الزواج الإسلامي؟',
                'answer_en' => 'To submit a tender request, create an account, go to the "Submit Tender" page, and fill in the required details about the service you need.',
                'answer_ar' => 'لتقديم طلب عطاء، قم بإنشاء حساب، ثم انتقل إلى صفحة "تقديم عطاء"، واملأ التفاصيل المطلوبة عن الخدمة التي تحتاجها.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_en' => 'What types of services can I find on this platform?',
                'question_ar' => 'ما أنواع الخدمات التي يمكنني العثور عليها في هذه المنصة؟',
                'answer_en' => 'Our platform connects users with service providers for halal matchmaking, Mahr and dowry consultations, wedding planning, and Islamic legal services.',
                'answer_ar' => 'تربط منصتنا المستخدمين بمقدمي الخدمات للتوفيق الحلال، واستشارات المهر والصداق، وتخطيط الزواج، والخدمات الشرعية الإسلامية.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_en' => 'Is there a verification process for service providers?',
                'question_ar' => 'هل يوجد عملية تحقق من مقدمي الخدمات؟',
                'answer_en' => 'Yes, all service providers undergo a verification process to ensure they adhere to Islamic principles and provide trustworthy services.',
                'answer_ar' => 'نعم، جميع مقدمي الخدمات يخضعون لعملية تحقق لضمان التزامهم بالمبادئ الإسلامية وتقديم خدمات موثوقة.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
