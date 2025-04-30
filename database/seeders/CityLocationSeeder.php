<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityLocationSeeder extends Seeder
{
    public function run()
    {
        DB::table('city_locations')->insert([
            // jordan
            // amman id --> 1 (108) area
            ['city_id' => 1, 'name_en' => 'Downtown', 'name_ar' => 'وسط البلد'],
            ['city_id' => 1, 'name_en' => 'Abdoun North', 'name_ar' => 'عبدون الشمالي'],
            ['city_id' => 1, 'name_en' => 'Abdoun South', 'name_ar' => 'عبدون الجنوبي'],
            ['city_id' => 1, 'name_en' => 'Shmeisani', 'name_ar' => 'الشميساني'],
            ['city_id' => 1, 'name_en' => 'Al-Suweifa', 'name_ar' => 'الصويفية'],
            ['city_id' => 1, 'name_en' => 'Khalda', 'name_ar' => 'خلدا'],
            ['city_id' => 1, 'name_en' => 'Dabouq', 'name_ar' => 'دابوق'],
            ['city_id' => 1, 'name_en' => 'Al-Jubayha', 'name_ar' => 'الجبيهة'],
            ['city_id' => 1, 'name_en' => 'Al-Rasheed District', 'name_ar' => 'ضاحية الرشيد'],
            ['city_id' => 1, 'name_en' => 'Al-Nakheel District', 'name_ar' => 'ضاحية النخيل'],
            ['city_id' => 1, 'name_en' => 'Um Uthayna', 'name_ar' => 'أم أذينة'],
            ['city_id' => 1, 'name_en' => 'Um Al-Samak', 'name_ar' => 'أم السماق'],
            ['city_id' => 1, 'name_en' => 'Tlaa Al-Ali', 'name_ar' => 'تلاع العلي'],
            ['city_id' => 1, 'name_en' => 'Jabal Al-Hussein', 'name_ar' => 'جبل الحسين'],
            ['city_id' => 1, 'name_en' => 'Jabal Al-Lweibdeh', 'name_ar' => 'جبل اللويبدة'],
            ['city_id' => 1, 'name_en' => 'Jabal Amman', 'name_ar' => 'جبل عمان'],
            ['city_id' => 1, 'name_en' => 'Jabal Al-Nasser', 'name_ar' => 'جبل النصر'],
            ['city_id' => 1, 'name_en' => 'Jabal Al-Jofa', 'name_ar' => 'جبل الجوفة'],
            ['city_id' => 1, 'name_en' => 'Hashmi North', 'name_ar' => 'الهاشمي الشمالي'],
            ['city_id' => 1, 'name_en' => 'Hashmi South', 'name_ar' => 'الهاشمي الجنوبي'],
            ['city_id' => 1, 'name_en' => 'Al-Mahatta', 'name_ar' => 'المحطة'],
            ['city_id' => 1, 'name_en' => 'Al-Bashir', 'name_ar' => 'البشير'],
            ['city_id' => 1, 'name_en' => 'Al-Yasmin', 'name_ar' => 'الياسمين'],
            ['city_id' => 1, 'name_en' => 'Al-Rabiah', 'name_ar' => 'الرابية'],
            ['city_id' => 1, 'name_en' => 'The Gardens', 'name_ar' => 'الجاردنز'],
            ['city_id' => 1, 'name_en' => 'Wadi Saqra', 'name_ar' => 'وادي صقرة'],
            ['city_id' => 1, 'name_en' => 'Al-Rawabi', 'name_ar' => 'الروابي'],
            ['city_id' => 1, 'name_en' => 'Al-Jandawil', 'name_ar' => 'الجندويل'],
            ['city_id' => 1, 'name_en' => 'Al-Kursi', 'name_ar' => 'الكرسي'],
            ['city_id' => 1, 'name_en' => 'Al-Rawnak', 'name_ar' => 'الرونق'],
            ['city_id' => 1, 'name_en' => 'Abu Nasir', 'name_ar' => 'أبو نصير'],
            ['city_id' => 1, 'name_en' => 'Al-Qweismeh', 'name_ar' => 'القويسمة'],
            ['city_id' => 1, 'name_en' => 'Kharibeh Souq', 'name_ar' => 'خريبة السوق'],
            ['city_id' => 1, 'name_en' => 'Marka', 'name_ar' => 'ماركا'],
            ['city_id' => 1, 'name_en' => 'Tariq', 'name_ar' => 'طارق'],
            ['city_id' => 1, 'name_en' => 'Ras Al-Ain', 'name_ar' => 'رأس العين'],
            ['city_id' => 1, 'name_en' => 'Al-Zuhur', 'name_ar' => 'الزهور'],
            ['city_id' => 1, 'name_en' => 'Al-Ashrafiya', 'name_ar' => 'الأشرفية'],
            ['city_id' => 1, 'name_en' => 'Al-Nazha', 'name_ar' => 'النزهة'],
            ['city_id' => 1, 'name_en' => 'Al-Zahra', 'name_ar' => 'الزهراء'],
            ['city_id' => 1, 'name_en' => 'Al-Rihan', 'name_ar' => 'الريحان'],
            ['city_id' => 1, 'name_en' => 'Al-Murooj', 'name_ar' => 'المروج'],
            ['city_id' => 1, 'name_en' => 'Al-Ayoun', 'name_ar' => 'العيون'],
            ['city_id' => 1, 'name_en' => 'Al-Manshiah', 'name_ar' => 'المنشية'],
            ['city_id' => 1, 'name_en' => 'Al-Dhira Al-Gharbi', 'name_ar' => 'الذراع الغربي'],
            ['city_id' => 1, 'name_en' => 'Bayader Wadi Al-Seer', 'name_ar' => 'بيادر وادي السير'],
            ['city_id' => 1, 'name_en' => 'Al-Muqabaleen', 'name_ar' => 'المقابلين'],
            ['city_id' => 1, 'name_en' => 'Nasser', 'name_ar' => 'نصر'],
            ['city_id' => 1, 'name_en' => 'Sweilih', 'name_ar' => 'صويلح'],
            ['city_id' => 1, 'name_en' => 'Shafa Badran', 'name_ar' => 'شفا بدران'],
            ['city_id' => 1, 'name_en' => 'Al-Amir Hassan District', 'name_ar' => 'ضاحية الأمير حسن'],
            ['city_id' => 1, 'name_en' => 'Al-Hussein District', 'name_ar' => 'ضاحية الحسين'],
            ['city_id' => 1, 'name_en' => 'Al-Yasmin District', 'name_ar' => 'ضاحية الياسمين'],
            ['city_id' => 1, 'name_en' => 'Al-Hussein Camp', 'name_ar' => 'مخيم الحسين'],
            ['city_id' => 1, 'name_en' => 'Kharibeh Souq (Duplicate)', 'name_ar' => 'خريبة السوق'],
            ['city_id' => 1, 'name_en' => 'Umm Qaseer', 'name_ar' => 'أم قصير'],
            ['city_id' => 1, 'name_en' => 'Al-Marijah', 'name_ar' => 'المريج'],
            ['city_id' => 1, 'name_en' => 'Al-Aamriya', 'name_ar' => 'العامرية'],
            ['city_id' => 1, 'name_en' => 'Al-Kharabsha', 'name_ar' => 'الخرابشة'],
            ['city_id' => 1, 'name_en' => 'Al-Jahamin', 'name_ar' => 'الجهامين'],
            ['city_id' => 1, 'name_en' => 'Sahab', 'name_ar' => 'سحاب'],
            ['city_id' => 1, 'name_en' => 'Um Al-Hiran', 'name_ar' => 'أم الحيران'],
            ['city_id' => 1, 'name_en' => 'Um Nuwara', 'name_ar' => 'أم نوارة'],
            ['city_id' => 1, 'name_en' => 'Al-Muhaysin', 'name_ar' => 'المحيسن'],
            ['city_id' => 1, 'name_en' => 'Al-Kharbah', 'name_ar' => 'الخربة'],
            ['city_id' => 1, 'name_en' => 'Al-Nasha', 'name_ar' => 'النشا'],
            ['city_id' => 1, 'name_en' => 'Southern Qweismeh', 'name_ar' => 'القويسمة الجنوبية'],
            ['city_id' => 1, 'name_en' => 'Al-Ruwaidi', 'name_ar' => 'الرويضي'],
            ['city_id' => 1, 'name_en' => 'Al-Mushta', 'name_ar' => 'المشتى'],
            ['city_id' => 1, 'name_en' => 'Al-Tunib', 'name_ar' => 'الطنيب'],
            ['city_id' => 1, 'name_en' => 'Industrial City', 'name_ar' => 'المدينة الصناعية'],
            ['city_id' => 1, 'name_en' => 'Al-Jubayha (Center)', 'name_ar' => 'الجبيهة (مركز اللواء)'],
            ['city_id' => 1, 'name_en' => 'Al-Rasheed District', 'name_ar' => 'ضاحية الرشيد'],
            ['city_id' => 1, 'name_en' => 'Um Al-Zaytoun', 'name_ar' => 'أم الزيتون'],
            ['city_id' => 1, 'name_en' => 'Kharibeh Zaytoun', 'name_ar' => 'خريبة الزيتون'],
            ['city_id' => 1, 'name_en' => 'Um Al-Amad', 'name_ar' => 'أم العمد'],
            ['city_id' => 1, 'name_en' => 'Al-Malaqat', 'name_ar' => 'المعلقات'],
            ['city_id' => 1, 'name_en' => 'Zaatari', 'name_ar' => 'الزعتري'],
            ['city_id' => 1, 'name_en' => 'Al-Damnah', 'name_ar' => 'الدمنة'],
            ['city_id' => 1, 'name_en' => 'Al-Salihi', 'name_ar' => 'السليحي'],
            ['city_id' => 1, 'name_en' => 'Al-Saffarin', 'name_ar' => 'الصفارين'],
            ['city_id' => 1, 'name_en' => 'Kharbah Al-Lawziyyin', 'name_ar' => 'خربة اللوزيين'],
            ['city_id' => 1, 'name_en' => 'Al-Iraqin', 'name_ar' => 'العراقين'],
            ['city_id' => 1, 'name_en' => 'Al-Maghayer', 'name_ar' => 'المغاير'],
            ['city_id' => 1, 'name_en' => 'Wadi Al-Seer (Center)', 'name_ar' => 'وادي السير (مركز اللواء)'],
            ['city_id' => 1, 'name_en' => 'Al-Amir Rashid District', 'name_ar' => 'ضاحية الأمير راشد'],
            ['city_id' => 1, 'name_en' => 'Bayader Wadi Al-Seer', 'name_ar' => 'بيادر وادي السير'],
            ['city_id' => 1, 'name_en' => 'Um Al-Basatin', 'name_ar' => 'أم البساتين'],
            ['city_id' => 1, 'name_en' => 'Um Atiyyah', 'name_ar' => 'أم عطية'],
            ['city_id' => 1, 'name_en' => 'Al-Alkumiah', 'name_ar' => 'العلكومية'],
            ['city_id' => 1, 'name_en' => 'Deir Ghabar', 'name_ar' => 'دير غبار'],
            ['city_id' => 1, 'name_en' => 'Al-Junaid', 'name_ar' => 'الجنيد'],
            ['city_id' => 1, 'name_en' => 'Al-Sanobar', 'name_ar' => 'الصنوبر'],
            ['city_id' => 1, 'name_en' => 'Um Al-Aswad', 'name_ar' => 'أم الأسود'],
            ['city_id' => 1, 'name_en' => 'Badr Al-Jadidah', 'name_ar' => 'بدر الجديدة'],
            ['city_id' => 1, 'name_en' => 'Al-Marj', 'name_ar' => 'المرج'],
            ['city_id' => 1, 'name_en' => 'Al-Rawda', 'name_ar' => 'الروضة'],
            ['city_id' => 1, 'name_en' => 'Al-Ayas', 'name_ar' => 'العياص'],
            ['city_id' => 1, 'name_en' => 'Al-Malaq', 'name_ar' => 'المعلق'],
            ['city_id' => 1, 'name_en' => 'Al-Kharbah (Duplicate)', 'name_ar' => 'الخربة'],
            ['city_id' => 1, 'name_en' => 'Al-Buqaa Camp', 'name_ar' => 'مخيم البقعة'],
            ['city_id' => 1, 'name_en' => 'Naour (Center)', 'name_ar' => 'ناعور (مركز اللواء)'],
            ['city_id' => 1, 'name_en' => 'Um Ramaneh', 'name_ar' => 'أم رمانة'],
            ['city_id' => 1, 'name_en' => 'Um Al-Basatin', 'name_ar' => 'أم البساتين'],
            ['city_id' => 1, 'name_en' => 'Um Al-Asakir', 'name_ar' => 'أم العساكر'],
            ['city_id' => 1, 'name_en' => 'Al-Bahath', 'name_ar' => 'البحاث'],
            ['city_id' => 1, 'name_en' => 'Al-Hadidah', 'name_ar' => 'الحديدة'],
            ['city_id' => 1, 'name_en' => 'Al-Kharbah (Duplicate)', 'name_ar' => 'الخربة'],
            ['city_id' => 1, 'name_en' => 'Sheikh Abdullah', 'name_ar' => 'الشيخ عبدالله'],
            ['city_id' => 1, 'name_en' => 'Al-Tafila', 'name_ar' => 'الطفيلة'],
            ['city_id' => 1, 'name_en' => 'Al-Malqaa', 'name_ar' => 'الملقى'],
            ['city_id' => 1, 'name_en' => 'Abu Al-Sous', 'name_ar' => 'أبو السوس'],
            ['city_id' => 1, 'name_en' => 'Um Qantara', 'name_ar' => 'أم قنطرة'],
            ['city_id' => 1, 'name_en' => 'Al-Dababeen', 'name_ar' => 'الدبابين'],
            ['city_id' => 1, 'name_en' => 'Al-Abdaliyah', 'name_ar' => 'العبدلية'],
            ['city_id' => 1, 'name_en' => 'Al-Rafiqah', 'name_ar' => 'الرفيقة'],
            ['city_id' => 1, 'name_en' => 'Al-Ruweihah', 'name_ar' => 'الرويحة'],
            ['city_id' => 1, 'name_en' => 'Dabeen', 'name_ar' => 'دبين'],
            ['city_id' => 1, 'name_en' => 'Suwayma', 'name_ar' => 'سويمة'],
            ['city_id' => 1, 'name_en' => 'Khillat Naamah', 'name_ar' => 'خلة الناعمة'],
            ['city_id' => 1, 'name_en' => 'Al-Jiza (Center)', 'name_ar' => 'الجيزة (مركز اللواء)'],
            ['city_id' => 1, 'name_en' => 'Um Al-Rasas', 'name_ar' => 'أم الرصاص'],
            ['city_id' => 1, 'name_en' => 'Um Al-Kindam', 'name_ar' => 'أم الكندم'],
            ['city_id' => 1, 'name_en' => 'Um Al-Qanadif', 'name_ar' => 'أم القنافذ'],
            ['city_id' => 1, 'name_en' => 'Al-Dhaybah', 'name_ar' => 'الذهيبة'],
            ['city_id' => 1, 'name_en' => 'Al-Ruqaym', 'name_ar' => 'الرقيم'],
            ['city_id' => 1, 'name_en' => 'Al-Murayghah', 'name_ar' => 'المريغة'],
            ['city_id' => 1, 'name_en' => 'Al-Tunur', 'name_ar' => 'التنور'],
            ['city_id' => 1, 'name_en' => 'Al-Shawabka', 'name_ar' => 'الشوابكة'],
            ['city_id' => 1, 'name_en' => 'Al-Amriyah', 'name_ar' => 'العامرية'],
            ['city_id' => 1, 'name_en' => 'Al-Qalaytat', 'name_ar' => 'القليطات'],
            ['city_id' => 1, 'name_en' => 'Al-Mudawwarah', 'name_ar' => 'المدورة'],
            ['city_id' => 1, 'name_en' => 'Al-Mu`amara', 'name_ar' => 'المعامرة'],
            ['city_id' => 1, 'name_en' => 'Khalet Al-Hassan', 'name_ar' => 'خلة الحسن'],
            ['city_id' => 1, 'name_en' => 'Khalet Al-Muhamid', 'name_ar' => 'خلة المحاميد'],
            ['city_id' => 1, 'name_en' => 'Abu Sayah', 'name_ar' => 'أبو صياح'],
            ['city_id' => 1, 'name_en' => 'Al-Muwaqar (Center)', 'name_ar' => 'الموقر (مركز اللواء)'],
            ['city_id' => 1, 'name_en' => 'Al-Jadidah', 'name_ar' => 'الجديدة'],
            ['city_id' => 1, 'name_en' => 'Um Al-Janabir', 'name_ar' => 'أم الجنابير'],
            ['city_id' => 1, 'name_en' => 'Al-Bayda', 'name_ar' => 'البيضاء'],
            ['city_id' => 1, 'name_en' => 'Al-Hadithah', 'name_ar' => 'الحديثة'],
            ['city_id' => 1, 'name_en' => 'Al-Rajim Al-Salem', 'name_ar' => 'الرجيم السالم'],
            ['city_id' => 1, 'name_en' => 'Al-Zubaydiyyah', 'name_ar' => 'الزبيدية'],
            ['city_id' => 1, 'name_en' => 'Sheikh Mansour', 'name_ar' => 'الشيخ منصور'],
            ['city_id' => 1, 'name_en' => 'Al-Abdaliyah', 'name_ar' => 'العبدلية'],
            ['city_id' => 1, 'name_en' => 'Al-Mushirf', 'name_ar' => 'المشيرف'],
            ['city_id' => 1, 'name_en' => 'Al-Mashhur', 'name_ar' => 'المشهور'],
            ['city_id' => 1, 'name_en' => 'Al-Kharbah', 'name_ar' => 'الخربة'],
            ['city_id' => 1, 'name_en' => 'Jadiyah', 'name_ar' => 'جادية'],
            ['city_id' => 1, 'name_en' => 'Rajm Al-Shami', 'name_ar' => 'رجم الشامي'],
            ['city_id' => 1, 'name_en' => 'Dumaykah', 'name_ar' => 'ضميكة'],
            ['city_id' => 1, 'name_en' => 'Hit', 'name_ar' => 'هيت'],
            ['city_id' => 1, 'name_en' => 'Kharbah Abu Sayah', 'name_ar' => 'خربة أبو صياح'],
            ['city_id' => 1, 'name_en' => 'Kharbah Al-Dair', 'name_ar' => 'خربة الدير'],
            ['city_id' => 1, 'name_en' => 'Kharbah Al-Maqran', 'name_ar' => 'خربة المقرن'],
            ['city_id' => 1, 'name_en' => 'Al-Qwismah (Center)', 'name_ar' => 'القويسمة (مركز اللواء)'],
            ['city_id' => 1, 'name_en' => 'Um Al-Samaq Al-Janubi', 'name_ar' => 'أم السماق الجنوبي'],
            ['city_id' => 1, 'name_en' => 'Al-Iraqi', 'name_ar' => 'العراقي'],
            ['city_id' => 1, 'name_en' => 'Al-Kharbah', 'name_ar' => 'الخربة'],
            ['city_id' => 1, 'name_en' => 'Al-Juwaidah', 'name_ar' => 'الجويدة'],
            ['city_id' => 1, 'name_en' => 'Al-Naqira', 'name_ar' => 'النقيرة'],
            ['city_id' => 1, 'name_en' => 'Al-Yadudah', 'name_ar' => 'اليادودة'],
            ['city_id' => 1, 'name_en' => 'Um Al-Husayn', 'name_ar' => 'أم الحصين'],
            ['city_id' => 1, 'name_en' => 'Um Kharbah', 'name_ar' => 'أم خربة'],
            ['city_id' => 1, 'name_en' => 'Al-Muheet', 'name_ar' => 'المحيط'],
            ['city_id' => 1, 'name_en' => 'Al-Manara', 'name_ar' => 'المنارة'],
            ['city_id' => 1, 'name_en' => 'Al-Shawabka', 'name_ar' => 'الشوابكة'],
            ['city_id' => 1, 'name_en' => 'Al-Murayghah', 'name_ar' => 'المريج'],
            ['city_id' => 1, 'name_en' => 'Marj Al-Hamam (Center)', 'name_ar' => 'مرج الحمام (مركز اللواء)'],
            ['city_id' => 1, 'name_en' => 'Dabouq', 'name_ar' => 'دابوق'],
            ['city_id' => 1, 'name_en' => 'Al-Baniyat', 'name_ar' => 'البنيات'],
            ['city_id' => 1, 'name_en' => 'Um Al-Amad', 'name_ar' => 'أم العمد'],
            ['city_id' => 1, 'name_en' => 'Al-Murayghah', 'name_ar' => 'المريج'],
            ['city_id' => 1, 'name_en' => 'Al-Kharbah', 'name_ar' => 'الخربة'],
            ['city_id' => 1, 'name_en' => 'Al-Shatna', 'name_ar' => 'الشطنا'],
            ['city_id' => 1, 'name_en' => 'Al-Dair', 'name_ar' => 'الدير'],
            ['city_id' => 1, 'name_en' => 'Al-Dubbah', 'name_ar' => 'الدبة'],
            ['city_id' => 1, 'name_en' => 'Al-Ruwaida', 'name_ar' => 'الرويحة'],
            ['city_id' => 1, 'name_en' => 'Al-Abdaliyah', 'name_ar' => 'العبدلية'],
            ['city_id' => 1, 'name_en' => 'Al-Muhamidh', 'name_ar' => 'المحاميد'],
            ['city_id' => 1, 'name_en' => 'Um Al-Abd', 'name_ar' => 'أم العبد'],
            ['city_id' => 1, 'name_en' => 'Um Al-Ghizlan', 'name_ar' => 'أم الغزلان'],
            ['city_id' => 1, 'name_en' => 'Khalet Al-Amad', 'name_ar' => 'خلة العمد'],
            ['city_id' => 1, 'name_en' => 'Khalet Al-Saghirah', 'name_ar' => 'خلة الصغيرة'],
            //Zarqa id -->2  (50) area

            ['city_id' => 2, 'name_en' => 'Zarqa City Center', 'name_ar' => 'وسط الزرقاء'],
            ['city_id' => 2, 'name_en' => 'Jabal Prince Faisal', 'name_ar' => 'جبل الأمير فيصل'],
            ['city_id' => 2, 'name_en' => 'Jabal Al-Marj', 'name_ar' => 'جبل المرج'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Jundi', 'name_ar' => 'حي الجندي'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Misfah', 'name_ar' => 'حي المصفاة'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Rashid', 'name_ar' => 'حي الرشيد'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Zuhur', 'name_ar' => 'حي الزهور'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Ghuwairiyah', 'name_ar' => 'حي الغويرية'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Nasr', 'name_ar' => 'حي النصر'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Betrawi', 'name_ar' => 'حي البتراوي'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Matar', 'name_ar' => 'حي المطار'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Dhubbat', 'name_ar' => 'حي الضباط'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Junayd', 'name_ar' => 'حي الجنيد'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Salihiyah', 'name_ar' => 'حي الصالحية'],
            ['city_id' => 2, 'name_en' => 'Hay Shabeeb', 'name_ar' => 'حي شبيب'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Muaskar', 'name_ar' => 'حي المعسكر'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Jabal Al-Abyad', 'name_ar' => 'حي الجبل الأبيض'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Dawaikat', 'name_ar' => 'حي الدويكات'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Muntasar', 'name_ar' => 'حي المنتصر'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Falah', 'name_ar' => 'حي الفلاح'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Hussein', 'name_ar' => 'حي الحسين'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Riyadh', 'name_ar' => 'حي الرياض'],
            ['city_id' => 2, 'name_en' => 'Zarqa Refugee Camp', 'name_ar' => 'مخيم الزرقاء'],
            ['city_id' => 2, 'name_en' => 'Al-Sultani', 'name_ar' => 'السلطاني'],
            ['city_id' => 2, 'name_en' => 'Um Al-Zaytun', 'name_ar' => 'أم الزيتون'],
            ['city_id' => 2, 'name_en' => 'Al-Murayghah', 'name_ar' => 'المريج'],
            ['city_id' => 2, 'name_en' => 'Al-Kharbah', 'name_ar' => 'الخربة'],
            ['city_id' => 2, 'name_en' => 'Al-Amriyah', 'name_ar' => 'العامرية'],
            ['city_id' => 2, 'name_en' => 'Rusayfah City Center', 'name_ar' => 'وسط الرصيفة'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Hadaiq', 'name_ar' => 'حي الحدائق'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Shaab', 'name_ar' => 'حي الشعب'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Rashad', 'name_ar' => 'حي الرشاد'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Zaytoun', 'name_ar' => 'حي الزيتون'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Nahda', 'name_ar' => 'حي النهضة'],
            ['city_id' => 2, 'name_en' => 'Hay Prince Mohammed', 'name_ar' => 'حي الأمير محمد'],
            ['city_id' => 2, 'name_en' => 'Hay Yajouz', 'name_ar' => 'حي ياجوز'],
            ['city_id' => 2, 'name_en' => 'Hay Al-Fahmawi', 'name_ar' => 'حي الفحماوي'],
            ['city_id' => 2, 'name_en' => 'Hattin Refugee Camp', 'name_ar' => 'مخيم حطين'],
            ['city_id' => 2, 'name_en' => 'Um Atiyah', 'name_ar' => 'أم عطية'],
            ['city_id' => 2, 'name_en' => 'Al-Dulayl', 'name_ar' => 'الضليل'],
            ['city_id' => 2, 'name_en' => 'Um Al-Rasas', 'name_ar' => 'أم الرصاص'],
            ['city_id' => 2, 'name_en' => 'Al-Mujib', 'name_ar' => 'الموجب'],
            ['city_id' => 2, 'name_en' => 'Sheikh Hussein', 'name_ar' => 'الشيخ حسين'],
            ['city_id' => 2, 'name_en' => 'Al-Arish', 'name_ar' => 'العريش'],
            ['city_id' => 2, 'name_en' => 'Al-Mahzam', 'name_ar' => 'المحزم'],
            ['city_id' => 2, 'name_en' => 'Al-Hashimiyah', 'name_ar' => 'الهاشمية'],
            ['city_id' => 2, 'name_en' => 'Um Khrouba', 'name_ar' => 'أم خروبة'],
            ['city_id' => 2, 'name_en' => 'Al-Mukhayba', 'name_ar' => 'المخيبة'],
            ['city_id' => 2, 'name_en' => 'Al-Zuwairiyah', 'name_ar' => 'الزويرية'],
            ['city_id' => 2, 'name_en' => 'Al-Sakhna', 'name_ar' => 'السخنة'],
            ['city_id' => 2, 'name_en' => 'Al-Manshiyah', 'name_ar' => 'المنشية'],
            ['city_id' => 2, 'name_en' => 'Al-Ain Al-Bayda', 'name_ar' => 'العين البيضاء'],
            ['city_id' => 2, 'name_en' => 'Al-Azraq Al-Shamali', 'name_ar' => 'الأزرق الشمالي'],
            ['city_id' => 2, 'name_en' => 'Al-Azraq Al-Janubi', 'name_ar' => 'الأزرق الجنوبي'],
            ['city_id' => 2, 'name_en' => 'Oasis Al-Azraq', 'name_ar' => 'واحة الأزرق'],
            ['city_id' => 2, 'name_en' => 'Al-Mansurah', 'name_ar' => 'المنصورة'],
            ['city_id' => 2, 'name_en' => 'Al-Zaytunah', 'name_ar' => 'الزيتونة'],
            ['city_id' => 2, 'name_en' => 'Al-Amari', 'name_ar' => 'العماري'],
            ['city_id' => 2, 'name_en' => 'Al-Dabba', 'name_ar' => 'الدبة'],
            ['city_id' => 2, 'name_en' => 'Birein', 'name_ar' => 'بيرين'],
            ['city_id' => 2, 'name_en' => 'Sumayya', 'name_ar' => 'سميا'],
            ['city_id' => 2, 'name_en' => 'Al-Muhammadiyah', 'name_ar' => 'المحمدية'],
            ['city_id' => 2, 'name_en' => 'Al-Hamra', 'name_ar' => 'الحمراء'],
            ['city_id' => 2, 'name_en' => 'Al-Ruwaishid', 'name_ar' => 'الرويشد'],
            ['city_id' => 2, 'name_en' => 'Al-Ain Al-Bayda', 'name_ar' => 'العين البيضاء'],

            // iribd (243)
            ['city_id' => 3, 'name_en' => 'Hai Al-Hoson', 'name_ar' => 'حي الحصن'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Nuzha', 'name_ar' => 'حي النزهة'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Marj', 'name_ar' => 'حي المرج'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Baraha', 'name_ar' => 'حي البارحة'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Manshiya', 'name_ar' => 'حي المنشية'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Tal', 'name_ar' => 'حي التل'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Hadaeq', 'name_ar' => 'حي الحدائق'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Rabieh', 'name_ar' => 'حي الرابية'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Yarmouk', 'name_ar' => 'حي اليرموك'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Mukhtar', 'name_ar' => 'حي المختار'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Zuhur', 'name_ar' => 'حي الزهور'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Manarah', 'name_ar' => 'حي المنارة'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Andalus', 'name_ar' => 'حي الأندلس'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Rawda', 'name_ar' => 'حي الروضة'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Jamia', 'name_ar' => 'حي الجامعة'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Hay Al-Sharqi', 'name_ar' => 'حي الحي الشرقي'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Hay Al-Gharbi', 'name_ar' => 'حي الحي الغربي'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Hay Al-Janoubi', 'name_ar' => 'حي الحي الجنوبي'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Safa', 'name_ar' => 'حي الصفا'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Murouj', 'name_ar' => 'حي المروج'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Iskan', 'name_ar' => 'حي الإسكان'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Amir Nayef', 'name_ar' => 'حي الأمير نايف'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Amir Rashed', 'name_ar' => 'حي الأمير راشد'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Jalil', 'name_ar' => 'حي الجليل'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Mualimeen', 'name_ar' => 'حي المعلمين'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Reihan', 'name_ar' => 'حي الريحان'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Qadisiyyah', 'name_ar' => 'حي القادسية'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Salam', 'name_ar' => 'حي السلام'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Munakh', 'name_ar' => 'حي المناخ'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Majd', 'name_ar' => 'حي المجد'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Naseem', 'name_ar' => 'حي النسيم'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Awda', 'name_ar' => 'حي العودة'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Riyad', 'name_ar' => 'حي الرياض'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Naimeh', 'name_ar' => 'حي النعيمة'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Atibaa', 'name_ar' => 'حي الأطباء'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Afrah', 'name_ar' => 'حي الأفراح'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Midan', 'name_ar' => 'حي الميدان'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Hashimi', 'name_ar' => 'حي الهاشمي'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Turkmen', 'name_ar' => 'حي التركمان'],
            ['city_id' => 3, 'name_en' => 'Hai Share\' Al-Jamia', 'name_ar' => 'حي شارع الجامعة'],
            ['city_id' => 3, 'name_en' => 'Hai Al-Malaab Al-Baladi', 'name_ar' => 'حي الملعب البلدي'],
            ['city_id' => 3, 'name_en' => 'Wadi Al-Ghufr Area', 'name_ar' => 'منطقة وادي الغفر'],
            ['city_id' => 3, 'name_en' => 'Irbid (center)', 'name_ar' => 'إربد (مركز اللواء)'],
            ['city_id' => 3, 'name_en' => 'Naimeh', 'name_ar' => 'النعيمة'],
            ['city_id' => 3, 'name_en' => 'Beit Ras', 'name_ar' => 'بيت راس'],
            ['city_id' => 3, 'name_en' => 'Bushra', 'name_ar' => 'بوشرا (بشرى)'],
            ['city_id' => 3, 'name_en' => 'Habras', 'name_ar' => 'حبراص'],
            ['city_id' => 3, 'name_en' => 'Howar', 'name_ar' => 'حور'],
            ['city_id' => 3, 'name_en' => 'Kufr Asad', 'name_ar' => 'كفر عساد'],
            ['city_id' => 3, 'name_en' => 'Kufr Rahta', 'name_ar' => 'كفر رحتا'],
            ['city_id' => 3, 'name_en' => 'Kufr Yuba', 'name_ar' => 'كفر يوبا'],
            ['city_id' => 3, 'name_en' => 'Asaerah', 'name_ar' => 'أسعرة'],
            ['city_id' => 3, 'name_en' => 'Wasifa', 'name_ar' => 'الوصيفة'],
            ['city_id' => 3, 'name_en' => 'Taqabal', 'name_ar' => 'تقبل'],
            ['city_id' => 3, 'name_en' => 'Um Al-Jadayel', 'name_ar' => 'أم الجدايل'],
            ['city_id' => 3, 'name_en' => 'Jamha', 'name_ar' => 'جمحة'],
            ['city_id' => 3, 'name_en' => 'Natfa', 'name_ar' => 'ناطفة'],
            ['city_id' => 3, 'name_en' => 'Fuwara', 'name_ar' => 'فوعرة'],
            ['city_id' => 3, 'name_en' => 'Makhoul', 'name_ar' => 'مكحول'],
            ['city_id' => 3, 'name_en' => 'Mandah', 'name_ar' => 'مندح'],
            ['city_id' => 3, 'name_en' => 'Zabda', 'name_ar' => 'زبدة'],
            ['city_id' => 3, 'name_en' => 'Um Qais', 'name_ar' => 'أم قيس'],
            ['city_id' => 3, 'name_en' => 'Juhfiyah', 'name_ar' => 'جحفية'],
            ['city_id' => 3, 'name_en' => 'Sheikh Mohammad', 'name_ar' => 'الشيخ محمد'],
            ['city_id' => 3, 'name_en' => 'Kharja', 'name_ar' => 'خرجا'],
            ['city_id' => 3, 'name_en' => 'Irbid Camp', 'name_ar' => 'مخيم إربد'],
            ['city_id' => 3, 'name_en' => 'Ramtha', 'name_ar' => 'الرمثا (مركز اللواء)'],
            ['city_id' => 3, 'name_en' => 'Tura', 'name_ar' => 'الطرة'],
            ['city_id' => 3, 'name_en' => 'Shajara', 'name_ar' => 'الشجرة'],
            ['city_id' => 3, 'name_en' => 'Uyun Al-Shaab', 'name_ar' => 'عيون الشعب'],
            ['city_id' => 3, 'name_en' => 'Ghraysah', 'name_ar' => 'غريسا'],
            ['city_id' => 3, 'name_en' => 'Ashari', 'name_ar' => 'الأشعري'],
            ['city_id' => 3, 'name_en' => 'Duqrah', 'name_ar' => 'الدوقرة'],
            ['city_id' => 3, 'name_en' => 'Samma', 'name_ar' => 'صما'],
            ['city_id' => 3, 'name_en' => 'Jaber', 'name_ar' => 'جابر'],
            ['city_id' => 3, 'name_en' => 'Annon', 'name_ar' => 'عانون'],
            ['city_id' => 3, 'name_en' => 'Rafid', 'name_ar' => 'الرفيد'],
            ['city_id' => 3, 'name_en' => 'Mukhaybah Fouqa', 'name_ar' => 'المخيبة الفوقا'],
            ['city_id' => 3, 'name_en' => 'Mukhaybah Tahta', 'name_ar' => 'المخيبة التحتا'],
            ['city_id' => 3, 'name_en' => 'Mughayer', 'name_ar' => 'المغير'],
            ['city_id' => 3, 'name_en' => 'Ain Ghazal', 'name_ar' => 'عين غزال'],
            ['city_id' => 3, 'name_en' => 'Samaa', 'name_ar' => 'سماع'],
            ['city_id' => 3, 'name_en' => 'Rihaniyah', 'name_ar' => 'الريحانية'],
            ['city_id' => 3, 'name_en' => 'Khalidiyah', 'name_ar' => 'الخالدية'],
            ['city_id' => 3, 'name_en' => 'Manshiyah', 'name_ar' => 'المنشية'],
            ['city_id' => 3, 'name_en' => 'Buwaydah', 'name_ar' => 'البويضة'],
            ['city_id' => 3, 'name_en' => 'Hamrah', 'name_ar' => 'الحمرة'],
            ['city_id' => 3, 'name_en' => 'Deir Abi Saeed', 'name_ar' => 'دير أبي سعيد (مركز اللواء)'],
            ['city_id' => 3, 'name_en' => 'Kufr Rakib', 'name_ar' => 'كفر راكب'],
            ['city_id' => 3, 'name_en' => 'Kufr Awan', 'name_ar' => 'كفر عوان'],
            ['city_id' => 3, 'name_en' => 'Kufr Abeel', 'name_ar' => 'كفر أبيل'],
            ['city_id' => 3, 'name_en' => 'Jenin Al-Safaa', 'name_ar' => 'جنين الصفا'],
            ['city_id' => 3, 'name_en' => 'Zamal', 'name_ar' => 'زمال'],
            ['city_id' => 3, 'name_en' => 'Tabariya', 'name_ar' => 'طبرية'],
            ['city_id' => 3, 'name_en' => 'Barqash', 'name_ar' => 'برقش'],
            ['city_id' => 3, 'name_en' => 'Ajloun Al-Koura', 'name_ar' => 'عجلون الكورة'],
            ['city_id' => 3, 'name_en' => 'Beit Eids', 'name_ar' => 'بيت إيدس'],
            ['city_id' => 3, 'name_en' => 'Kufr Al-Maa', 'name_ar' => 'كفر الماء'],
            ['city_id' => 3, 'name_en' => 'Rubaid Al-Gharbi', 'name_ar' => 'ربيض الغربي'],
            ['city_id' => 3, 'name_en' => 'Al-Junaid', 'name_ar' => 'الجنيد'],
            ['city_id' => 3, 'name_en' => 'Um Al-Yanabee', 'name_ar' => 'أم الينابيع'],
            ['city_id' => 3, 'name_en' => 'Abin', 'name_ar' => 'عبين'],
            ['city_id' => 3, 'name_en' => 'Ain Al-Rihab', 'name_ar' => 'عين الرحاب'],
            ['city_id' => 3, 'name_en' => 'Samoa', 'name_ar' => 'سموع'],
            ['city_id' => 3, 'name_en' => 'Khreibat Al-Koura', 'name_ar' => 'خريبة الكورة'],
            ['city_id' => 3, 'name_en' => 'Balila', 'name_ar' => 'بليلة'],
            ['city_id' => 3, 'name_en' => 'Al-Jabal Al-Akhdar', 'name_ar' => 'الجبل الأخضر'],
            ['city_id' => 3, 'name_en' => 'Deir Yusuf', 'name_ar' => 'دير يوسف'],
            ['city_id' => 3, 'name_en' => 'Mareisah', 'name_ar' => 'مريصع'],
            ['city_id' => 3, 'name_en' => 'Al-Kfour', 'name_ar' => 'الكفور'],
            ['city_id' => 3, 'name_en' => 'Yebla', 'name_ar' => 'يبلا (مركز اللواء)'],
            ['city_id' => 3, 'name_en' => 'Hirma', 'name_ar' => 'حريما'],
            ['city_id' => 3, 'name_en' => 'Hatim', 'name_ar' => 'حاتم'],
            ['city_id' => 3, 'name_en' => 'Samad', 'name_ar' => 'صمد'],
            ['city_id' => 3, 'name_en' => 'Al-Khreeba', 'name_ar' => 'الخربة'],
            ['city_id' => 3, 'name_en' => 'Ain Jana', 'name_ar' => 'عين جنا'],
            ['city_id' => 3, 'name_en' => 'Som', 'name_ar' => 'سوم'],
            ['city_id' => 3, 'name_en' => 'Malka', 'name_ar' => 'ملكا'],
            ['city_id' => 3, 'name_en' => 'Al-Aamerya', 'name_ar' => 'العامرية'],
            ['city_id' => 3, 'name_en' => 'Balad Al-Sheikh', 'name_ar' => 'بلد الشيخ'],
            ['city_id' => 3, 'name_en' => 'Shatna', 'name_ar' => 'شطنا'],
            ['city_id' => 3, 'name_en' => 'Al-Haditha', 'name_ar' => 'الحديثة'],
            ['city_id' => 3, 'name_en' => 'Al-Rafa’a', 'name_ar' => 'الرافعة'],
            ['city_id' => 3, 'name_en' => 'Al-Asha', 'name_ar' => 'العشة'],
            ['city_id' => 3, 'name_en' => 'Al-Maqam', 'name_ar' => 'المقام'],
            ['city_id' => 3, 'name_en' => 'Um Al-Ghazlan', 'name_ar' => 'أم الغزلان'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Ras', 'name_ar' => 'خربة الراس'],
            ['city_id' => 3, 'name_en' => 'Kufr Som', 'name_ar' => 'كفر سوم'],
            ['city_id' => 3, 'name_en' => 'Jojar', 'name_ar' => 'جوجر'],
            ['city_id' => 3, 'name_en' => 'Al-Safira', 'name_ar' => 'السفيرة'],
            ['city_id' => 3, 'name_en' => 'Deir Al-Saana', 'name_ar' => 'دير السعنة'],
            ['city_id' => 3, 'name_en' => 'Al-Areef', 'name_ar' => 'العريف'],
            ['city_id' => 3, 'name_en' => 'Um Al-Khoroub', 'name_ar' => 'أم الخروب'],
            // مناطق الحصن
            ['city_id' => 3, 'name_en' => 'Al-Hosn', 'name_ar' => 'الحصن (مركز اللواء)'],
            ['city_id' => 3, 'name_en' => 'Al-Sarih', 'name_ar' => 'الصريح'],
            ['city_id' => 3, 'name_en' => 'Balad Al-Sheikh', 'name_ar' => 'بلد الشيخ'],
            ['city_id' => 3, 'name_en' => 'Kufr Jayz', 'name_ar' => 'كفر جايز'],
            ['city_id' => 3, 'name_en' => 'Al-Bustan', 'name_ar' => 'البستان'],
            ['city_id' => 3, 'name_en' => 'Al-Mugheir', 'name_ar' => 'المغير'],
            ['city_id' => 3, 'name_en' => 'Um Al-Khanazir', 'name_ar' => 'أم الخنازير'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Tayyar', 'name_ar' => 'خربة الطيار'],
            ['city_id' => 3, 'name_en' => 'Ain Al-Rumman', 'name_ar' => 'عين الرمان'],
            ['city_id' => 3, 'name_en' => 'Ain Al-Hamra', 'name_ar' => 'عين الحمراء'],
            ['city_id' => 3, 'name_en' => 'Dawqara', 'name_ar' => 'دوقرة'],
            ['city_id' => 3, 'name_en' => 'Zahr', 'name_ar' => 'زحر'],
            ['city_id' => 3, 'name_en' => 'Ain Al-Muqil', 'name_ar' => 'عين المقل'],
            ['city_id' => 3, 'name_en' => 'Al-Qusayfa', 'name_ar' => 'القصيفة'],
            ['city_id' => 3, 'name_en' => 'Al-Hadid', 'name_ar' => 'الحديد'],
            ['city_id' => 3, 'name_en' => 'Kufr Al-Dair', 'name_ar' => 'كفر الدير'],
            ['city_id' => 3, 'name_en' => 'Um Khirba', 'name_ar' => 'أم خربة'],
            ['city_id' => 3, 'name_en' => 'Al-Shu’la', 'name_ar' => 'الشعلة'],
            ['city_id' => 3, 'name_en' => 'Deir Awad', 'name_ar' => 'دير عواد'],
            ['city_id' => 3, 'name_en' => 'Abu Al-Luqas', 'name_ar' => 'أبو اللوقس'],
            ['city_id' => 3, 'name_en' => 'Al-Baara', 'name_ar' => 'البارحة'],
            ['city_id' => 3, 'name_en' => 'Kharbat Ain', 'name_ar' => 'خربة عين'],
            ['city_id' => 3, 'name_en' => 'Al-Aqab', 'name_ar' => 'العاقب'],
            ['city_id' => 3, 'name_en' => 'Al-Mushirf', 'name_ar' => 'المشيرف'],
            ['city_id' => 3, 'name_en' => 'Al-Maamara', 'name_ar' => 'المعامرة'],
            // الشونة الشمالية
            ['city_id' => 3, 'name_en' => 'Al-Shunah Al-Shamaliyah', 'name_ar' => 'الشونة الشمالية (مركز اللواء)'],
            ['city_id' => 3, 'name_en' => 'Al-Masha', 'name_ar' => 'المشه'],
            ['city_id' => 3, 'name_en' => 'Al-Manshiyah', 'name_ar' => 'المنشية'],
            ['city_id' => 3, 'name_en' => 'Kharbat Ayoun', 'name_ar' => 'خربة عيون'],
            ['city_id' => 3, 'name_en' => 'Al-Mukhtariya', 'name_ar' => 'المختارية'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Adir', 'name_ar' => 'خربة الأدير'],
            ['city_id' => 3, 'name_en' => 'Abu Seedo', 'name_ar' => 'أبو سيدو'],
            ['city_id' => 3, 'name_en' => 'Um Khorouba', 'name_ar' => 'أم خروبة'],
            ['city_id' => 3, 'name_en' => 'Al-Muhtar', 'name_ar' => 'المغتر'],
            ['city_id' => 3, 'name_en' => 'Zourba', 'name_ar' => 'زوربا'],
            ['city_id' => 3, 'name_en' => 'Al-Muadi', 'name_ar' => 'المعاضي'],
            ['city_id' => 3, 'name_en' => 'Karima', 'name_ar' => 'كريمه'],
            ['city_id' => 3, 'name_en' => 'Al-Adsiya', 'name_ar' => 'العدسية'],
            ['city_id' => 3, 'name_en' => 'Al-Ruwaiha', 'name_ar' => 'الرويحة'],
            ['city_id' => 3, 'name_en' => 'Al-Naqab', 'name_ar' => 'النقب'],
            ['city_id' => 3, 'name_en' => 'Al-Alouk', 'name_ar' => 'العالوك'],
            ['city_id' => 3, 'name_en' => 'Kharbat Sheikh Hussein', 'name_ar' => 'خربة الشيخ حسين'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Hammam', 'name_ar' => 'خربة الحمام'],
            ['city_id' => 3, 'name_en' => 'Al-Muqar', 'name_ar' => 'الموقر'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Tawal', 'name_ar' => 'خربة الطوال'],
            ['city_id' => 3, 'name_en' => 'Sheikh Muhammad', 'name_ar' => 'الشيخ محمد'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Noor', 'name_ar' => 'خربة النور'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Saghira', 'name_ar' => 'خربة الصغيرة'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Kurdi', 'name_ar' => 'خربة الكردي'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Jamal', 'name_ar' => 'خربة الجمل'],

            // المزار الشمالي
            ['city_id' => 3, 'name_en' => 'Al-Mazar Al-Shamali', 'name_ar' => 'المزار الشمالي (مركز اللواء)'],
            ['city_id' => 3, 'name_en' => 'Idoun', 'name_ar' => 'إيدون'],
            ['city_id' => 3, 'name_en' => 'Hawara', 'name_ar' => 'حوارة'],
            ['city_id' => 3, 'name_en' => 'Zahr', 'name_ar' => 'زحر'],
            ['city_id' => 3, 'name_en' => 'Daraa', 'name_ar' => 'درعا'],
            ['city_id' => 3, 'name_en' => 'Samiya', 'name_ar' => 'سميع'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Bariya', 'name_ar' => 'خربة البرية'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Manara', 'name_ar' => 'خربة المنارة'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Shibli', 'name_ar' => 'خربة الشبلي'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Qara’an', 'name_ar' => 'خربة القرعان'],
            ['city_id' => 3, 'name_en' => 'Kharbat Sheikh Ajloun', 'name_ar' => 'خربة الشيخ عجلون'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Nawafla', 'name_ar' => 'خربة النوافلة'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Ayoun', 'name_ar' => 'خربة العيون'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Saghir', 'name_ar' => 'خربة الصغير'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Jadida', 'name_ar' => 'خربة الجديدة'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Hamra', 'name_ar' => 'خربة الحمراء'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Shajra', 'name_ar' => 'خربة الشجرة'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Zaitar', 'name_ar' => 'خربة الزعتر'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Khroub', 'name_ar' => 'خربة الخروب'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Sous', 'name_ar' => 'خربة السوس'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Maamariya', 'name_ar' => 'خربة المعامرية'],

            //  الرافع
            ['city_id' => 3, 'name_en' => 'Al-Rafa’', 'name_ar' => 'الرافع (مركز اللواء)'],
            ['city_id' => 3, 'name_en' => 'Kufr Aan', 'name_ar' => 'كفر عان'],
            ['city_id' => 3, 'name_en' => 'Dabeen', 'name_ar' => 'دبين'],
            ['city_id' => 3, 'name_en' => 'Ain Jana', 'name_ar' => 'عين جنة'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Dair', 'name_ar' => 'خربة الدير'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Nakhl', 'name_ar' => 'خربة النخل'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Manara', 'name_ar' => 'خربة المنارة'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Ayoun', 'name_ar' => 'خربة العيون'],
            ['city_id' => 3, 'name_en' => 'Kharbat Sheikh Ajloun', 'name_ar' => 'خربة الشيخ عجلون'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Mugheir', 'name_ar' => 'خربة المغير'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Saghir', 'name_ar' => 'خربة الصغير'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Hamra', 'name_ar' => 'خربة الحمراء'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Shajra', 'name_ar' => 'خربة الشجرة'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Zaitar', 'name_ar' => 'خربة الزعتر'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Khroub', 'name_ar' => 'خربة الخروب'],
            // الطيبة
            ['city_id' => 3, 'name_en' => 'Al-Taybah', 'name_ar' => 'الطيبة (مركز اللواء)'],
            ['city_id' => 3, 'name_en' => 'Ain Al-Maqal', 'name_ar' => 'عين المقل'],
            ['city_id' => 3, 'name_en' => 'Al-Qusayfah', 'name_ar' => 'القصيفة'],
            ['city_id' => 3, 'name_en' => 'Al-Hadid', 'name_ar' => 'الحديد'],
            ['city_id' => 3, 'name_en' => 'Kafr Al-Deir', 'name_ar' => 'كفر الدير'],
            ['city_id' => 3, 'name_en' => 'Um Kharbah', 'name_ar' => 'أم خربة'],
            ['city_id' => 3, 'name_en' => 'Al-Shu’lah', 'name_ar' => 'الشعلة'],
            ['city_id' => 3, 'name_en' => 'Deir Awad', 'name_ar' => 'دير عواد'],
            ['city_id' => 3, 'name_en' => 'Abu Al-Louqs', 'name_ar' => 'أبو اللوقس'],
            ['city_id' => 3, 'name_en' => 'Al-Barihah', 'name_ar' => 'البارحة'],
            ['city_id' => 3, 'name_en' => 'Kharbat Ain', 'name_ar' => 'خربة عين'],
            ['city_id' => 3, 'name_en' => 'Al-Aqab', 'name_ar' => 'العاقب'],
            ['city_id' => 3, 'name_en' => 'Al-Mushayrif', 'name_ar' => 'المشيرف'],
            ['city_id' => 3, 'name_en' => 'Al-Ma’amrah', 'name_ar' => 'المعامرة'],
            ['city_id' => 3, 'name_en' => 'Kharbat Al-Tayyir', 'name_ar' => 'خربة الطيار'],
            ['city_id' => 3, 'name_en' => 'Ain Al-Rumman', 'name_ar' => 'عين الرمان'],
            ['city_id' => 3, 'name_en' => 'Ain Al-Hamrah', 'name_ar' => 'عين الحمراء'],
            ['city_id' => 3, 'name_en' => 'Dawqrah', 'name_ar' => 'دوقرة'],
            // Aqaba (56)
            ['city_id' => 4, 'name_en' => 'First District (City Center)', 'name_ar' => 'الحي الأول (وسط المدينة)'],
            ['city_id' => 4, 'name_en' => 'Second District', 'name_ar' => 'الحي الثاني'],
            ['city_id' => 4, 'name_en' => 'Third District', 'name_ar' => 'الحي الثالث'],
            ['city_id' => 4, 'name_en' => 'Fourth District', 'name_ar' => 'الحي الرابع'],
            ['city_id' => 4, 'name_en' => 'Fifth District', 'name_ar' => 'الحي الخامس'],
            ['city_id' => 4, 'name_en' => 'Sixth District', 'name_ar' => 'الحي السادس'],
            ['city_id' => 4, 'name_en' => 'Seventh District', 'name_ar' => 'الحي السابع'],
            ['city_id' => 4, 'name_en' => 'Eighth District', 'name_ar' => 'الحي الثامن'],
            ['city_id' => 4, 'name_en' => 'Ninth District', 'name_ar' => 'الحي التاسع'],
            ['city_id' => 4, 'name_en' => 'Tenth District', 'name_ar' => 'الحي العاشر'],
            ['city_id' => 4, 'name_en' => 'Eleventh District', 'name_ar' => 'الحي الحادي عشر'],
            ['city_id' => 4, 'name_en' => 'Port Area', 'name_ar' => 'منطقة الميناء'],
            ['city_id' => 4, 'name_en' => 'South Beach Area', 'name_ar' => 'منطقة الشاطئ الجنوبي'],
            ['city_id' => 4, 'name_en' => 'North Beach Area', 'name_ar' => 'منطقة الشاطئ الشمالي'],
            ['city_id' => 4, 'name_en' => 'Ayla Oasis Area', 'name_ar' => 'منطقة واحة آيلة'],
            ['city_id' => 4, 'name_en' => 'Saraya Aqaba Area', 'name_ar' => 'منطقة سرايا العقبة'],
            ['city_id' => 4, 'name_en' => 'Marsa Zayed Area', 'name_ar' => 'منطقة مرسى زايد'],
            ['city_id' => 4, 'name_en' => 'Al-Talawi District', 'name_ar' => 'حي التلاوي'],
            ['city_id' => 4, 'name_en' => 'Al-Nakhil District', 'name_ar' => 'حي النخيل'],
            ['city_id' => 4, 'name_en' => 'New Aqaba District', 'name_ar' => 'حي العقبة الجديدة'],
            ['city_id' => 4, 'name_en' => 'Industrial Area', 'name_ar' => 'منطقة المنطقة الصناعية'],
            ['city_id' => 4, 'name_en' => 'Hotel Area', 'name_ar' => 'منطقة الفنادق'],
            ['city_id' => 4, 'name_en' => 'Al-Rawabi District', 'name_ar' => 'حي الروابي'],
            ['city_id' => 4, 'name_en' => 'Airport District', 'name_ar' => 'حي المطار'],
            ['city_id' => 4, 'name_en' => 'Shallalah District', 'name_ar' => 'حي الشلالة'],
            ['city_id' => 4, 'name_en' => 'Al-Amayer District', 'name_ar' => 'حي العماير'],
            ['city_id' => 4, 'name_en' => 'Al-Dajnah Area', 'name_ar' => 'منطقة الدجنة'],
            ['city_id' => 4, 'name_en' => 'Al-Durra', 'name_ar' => 'الدرة'],
            ['city_id' => 4, 'name_en' => 'Al-Mazfar', 'name_ar' => 'المزفر'],
            ['city_id' => 4, 'name_en' => 'Tatan', 'name_ar' => 'تتن'],
            ['city_id' => 4, 'name_en' => 'Bir Midhkor', 'name_ar' => 'بير مذكور'],
            ['city_id' => 4, 'name_en' => 'Khurbet Al-Nahas', 'name_ar' => 'خربة النحاس'],
            ['city_id' => 4, 'name_en' => 'Al-Risha', 'name_ar' => 'الريشة'],
            ['city_id' => 4, 'name_en' => 'Qatar', 'name_ar' => 'قطر'],
            ['city_id' => 4, 'name_en' => 'Rahma', 'name_ar' => 'رحمة'],
            ['city_id' => 4, 'name_en' => 'Bir Jbeil', 'name_ar' => 'بير جبيل'],
            ['city_id' => 4, 'name_en' => 'Bir Mdkour', 'name_ar' => 'بير مدكور'],
            ['city_id' => 4, 'name_en' => 'Al-Rajif', 'name_ar' => 'الرجيف'],
            ['city_id' => 4, 'name_en' => 'Ain Al-Shamiyah', 'name_ar' => 'عين الشامية'],
            ['city_id' => 4, 'name_en' => 'Grindal', 'name_ar' => 'غرندل'],
            ['city_id' => 4, 'name_en' => 'Khurbet Al-Fannan', 'name_ar' => 'خربة الفنّان'],
            ['city_id' => 4, 'name_en' => 'Ain Al-Bayda', 'name_ar' => 'عين البيضاء'],
            ['city_id' => 4, 'name_en' => 'Al-Qweira', 'name_ar' => 'القويرة'],
            ['city_id' => 4, 'name_en' => 'Al-Rashidiya', 'name_ar' => 'الراشدية'],
            ['city_id' => 4, 'name_en' => 'Ram (Wadi Rum)', 'name_ar' => 'رم (وادي رم)'],
            ['city_id' => 4, 'name_en' => 'Al-Humeima Al-Jadida', 'name_ar' => 'الحميمة الجديدة'],
            ['city_id' => 4, 'name_en' => 'Dabba Hanout', 'name_ar' => 'دبة حانوت'],
            ['city_id' => 4, 'name_en' => 'Al-Shakriya', 'name_ar' => 'الشاكرية'],
            ['city_id' => 4, 'name_en' => 'Al-Salihiya', 'name_ar' => 'الصالحية'],
            ['city_id' => 4, 'name_en' => 'Al-Asaliya', 'name_ar' => 'العسلية'],
            ['city_id' => 4, 'name_en' => 'Ain Al-Hawara', 'name_ar' => 'عين الهوارة'],
            ['city_id' => 4, 'name_en' => 'Al-Humeima', 'name_ar' => 'الحميمة'],
            ['city_id' => 4, 'name_en' => 'Khurbet Al-Qariqra', 'name_ar' => 'خربة القريقرة'],
            ['city_id' => 4, 'name_en' => 'Khurbet Al-Najada', 'name_ar' => 'خربة النجادة'],
            ['city_id' => 4, 'name_en' => 'Al-Disa', 'name_ar' => 'الديسة'],
            ['city_id' => 4, 'name_en' => 'Al-Jafr', 'name_ar' => 'الجفر'],
            ['city_id' => 4, 'name_en' => 'Umm Al-Sawan', 'name_ar' => 'أم الصوان'],
            //mafaraq
            ['city_id' => 5, 'name_en' => 'Al-Hay Al-Sharqi', 'name_ar' => 'الحي الشرقي'],
            ['city_id' => 5, 'name_en' => 'Al-Hay Al-Gharbi', 'name_ar' => 'الحي الغربي'],
            ['city_id' => 5, 'name_en' => 'Al-Hay Al-Shamali', 'name_ar' => 'الحي الشمالي'],
            ['city_id' => 5, 'name_en' => 'Al-Hay Al-Janubi', 'name_ar' => 'الحي الجنوبي'],
            ['city_id' => 5, 'name_en' => 'Hay Al-Fadeen (Archaeological Area)', 'name_ar' => 'حي الفدين (المنطقة الأثرية)'],
            ['city_id' => 5, 'name_en' => 'Hay Wasat Al-Balad', 'name_ar' => 'حي وسط البلد'],
            ['city_id' => 5, 'name_en' => 'Hay Al-Zuhur', 'name_ar' => 'حي الزهور'],
            ['city_id' => 5, 'name_en' => 'Hay Al-Rabiya', 'name_ar' => 'حي الرابية'],
            ['city_id' => 5, 'name_en' => 'Hay Al-Nuzha', 'name_ar' => 'حي النزهة'],
            ['city_id' => 5, 'name_en' => 'Hay Al-Matar', 'name_ar' => 'حي المطار'],
            ['city_id' => 5, 'name_en' => 'Hay Al-Jami\'a (Near Al-Bayt University)', 'name_ar' => 'حي الجامعة (قرب جامعة آل البيت)'],
            ['city_id' => 5, 'name_en' => 'Hay Al-Dubat', 'name_ar' => 'حي الضباط'],
            ['city_id' => 5, 'name_en' => 'Hay Al-`Amal', 'name_ar' => 'حي العمال'],
            ['city_id' => 5, 'name_en' => 'Hay Al-Sinaiya', 'name_ar' => 'حي الصناعية'],
            ['city_id' => 5, 'name_en' => 'Hay Al-Mahatta (Near Railway)', 'name_ar' => 'حي المحطة (قرب سكة الحديد)'],
            ['city_id' => 5, 'name_en' => 'Hay Al-Rawda', 'name_ar' => 'حي الروضة'],
            ['city_id' => 5, 'name_en' => 'Hay Al-Amir Muhammad', 'name_ar' => 'حي الأمير محمد'],
            ['city_id' => 5, 'name_en' => 'Hay Al-Amir Talal', 'name_ar' => 'حي الأمير طلال'],
            ['city_id' => 5, 'name_en' => 'Hay Al-Salam', 'name_ar' => 'حي السلام'],
            ['city_id' => 5, 'name_en' => 'Hay Al-Yarmouk', 'name_ar' => 'حي اليرموك'],
            ['city_id' => 5, 'name_en' => 'Idoun', 'name_ar' => 'إيدون'],
            ['city_id' => 5, 'name_en' => 'Idoun Bani Hassan', 'name_ar' => 'إيدون بني حسن'],
            ['city_id' => 5, 'name_en' => 'Rahab', 'name_ar' => 'رحاب'],
            ['city_id' => 5, 'name_en' => 'Zamal', 'name_ar' => 'زمال'],
            ['city_id' => 5, 'name_en' => 'Al-Khalidiya', 'name_ar' => 'الخالدية'],
            ['city_id' => 5, 'name_en' => 'Al-Mukhaybah Fouqa', 'name_ar' => 'المخيبة الفوقا'],
            ['city_id' => 5, 'name_en' => 'Al-Mukhaybah Tahta', 'name_ar' => 'المخيبة التحتا'],
            ['city_id' => 5, 'name_en' => 'Manshiya Al-Sagheer', 'name_ar' => 'منشية الصغير'],
            ['city_id' => 5, 'name_en' => 'Deir Al-Kahf', 'name_ar' => 'دير الكهف'],
            ['city_id' => 5, 'name_en' => 'Sama', 'name_ar' => 'سماع'],
            ['city_id' => 5, 'name_en' => 'Al-Qasr', 'name_ar' => 'القصر'],
            ['city_id' => 5, 'name_en' => 'Umm Al-Jamal', 'name_ar' => 'أم الجمال'],
            ['city_id' => 5, 'name_en' => 'Umm Al-Qutayn', 'name_ar' => 'أم القطين'],
            ['city_id' => 5, 'name_en' => 'Sama Al-Sarhan', 'name_ar' => 'سما السرحان'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Samra', 'name_ar' => 'خربة السمراء'],
            ['city_id' => 5, 'name_en' => 'Al-Dfiana', 'name_ar' => 'الدفيانة'],
            ['city_id' => 5, 'name_en' => 'Al-Safawi', 'name_ar' => 'الصفاوي'],
            ['city_id' => 5, 'name_en' => 'Al-Murabba', 'name_ar' => 'المربعة'],
            ['city_id' => 5, 'name_en' => 'Al-Hamidiyya', 'name_ar' => 'الحميدية'],
            ['city_id' => 5, 'name_en' => 'Al-Jandil', 'name_ar' => 'الجنديل'],
            ['city_id' => 5, 'name_en' => 'Al-Safawi (Al-Liwa Center)', 'name_ar' => 'الصفاوي (مركز اللواء)'],
            ['city_id' => 5, 'name_en' => 'Umm Al-Na`am Al-Sharqiya', 'name_ar' => 'أم النعام الشرقية'],
            ['city_id' => 5, 'name_en' => 'Umm Al-Na`am Al-Gharbiya', 'name_ar' => 'أم النعام الغربية'],
            ['city_id' => 5, 'name_en' => 'Al-Hashmiya Al-Sharqiya', 'name_ar' => 'الهاشمية الشرقية'],
            ['city_id' => 5, 'name_en' => 'Bani Hashim', 'name_ar' => 'بني هاشم'],
            ['city_id' => 5, 'name_en' => 'Tel Ramah', 'name_ar' => 'تل رماح'],
            ['city_id' => 5, 'name_en' => 'Al-Hamra', 'name_ar' => 'الحمراء'],
            ['city_id' => 5, 'name_en' => 'Al-Jabriya', 'name_ar' => 'الجابرية'],
            ['city_id' => 5, 'name_en' => 'Al-Manshiya', 'name_ar' => 'المنشية'],
            ['city_id' => 5, 'name_en' => 'Al-Khalidiya', 'name_ar' => 'الخالدية'],
            ['city_id' => 5, 'name_en' => 'Al-Arsh', 'name_ar' => 'العرش'],
            ['city_id' => 5, 'name_en' => 'Al-Husayniya', 'name_ar' => 'الحسينية'],
            ['city_id' => 5, 'name_en' => 'Al-Rafaiya', 'name_ar' => 'الرفاعية'],
            ['city_id' => 5, 'name_en' => 'Al-Mushirif', 'name_ar' => 'المشيرف'],
            ['city_id' => 5, 'name_en' => 'Khurbet Ayad', 'name_ar' => 'خربة عياد'],
            ['city_id' => 5, 'name_en' => 'Khurbet Sheikh Muhammad', 'name_ar' => 'خربة الشيخ محمد'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Aniyza', 'name_ar' => 'خربة العنيزة'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Manara', 'name_ar' => 'خربة المنارة'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Saghira', 'name_ar' => 'خربة الصغيرة'],
            ['city_id' => 5, 'name_en' => 'Al-Ruwaishid (Al-Liwa Center)', 'name_ar' => 'الرويشد (مركز اللواء)'],
            ['city_id' => 5, 'name_en' => 'Al-Ja\'wa', 'name_ar' => 'الجاوا'],
            ['city_id' => 5, 'name_en' => 'Al-Haditha', 'name_ar' => 'الحديثة'],
            ['city_id' => 5, 'name_en' => 'Al-Omari', 'name_ar' => 'العمري'],
            ['city_id' => 5, 'name_en' => 'Al-Muhammadiya', 'name_ar' => 'المحمدية'],
            ['city_id' => 5, 'name_en' => 'Al-Naqira', 'name_ar' => 'النقيرة'],
            ['city_id' => 5, 'name_en' => 'Khurbet Samra', 'name_ar' => 'خربة سمرا'],
            ['city_id' => 5, 'name_en' => 'Khurbet Awad', 'name_ar' => 'خربة عواد'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Khalidiya', 'name_ar' => 'خربة الخالدية'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Noor', 'name_ar' => 'خربة النور'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Shallan', 'name_ar' => 'خربة الشعلان'],
            ['city_id' => 5, 'name_en' => 'Salihiya Al-Kurdi (Al-Liwa Center)', 'name_ar' => 'صالحية الكردي (مركز اللواء)'],
            ['city_id' => 5, 'name_en' => 'Umm Al-Sarb', 'name_ar' => 'أم السرب'],
            ['city_id' => 5, 'name_en' => 'Deir Al-Saad', 'name_ar' => 'دير السعد'],
            ['city_id' => 5, 'name_en' => 'Al-Jadida', 'name_ar' => 'الجديدة'],
            ['city_id' => 5, 'name_en' => 'Al-Zaatari', 'name_ar' => 'الزعتري'],
            ['city_id' => 5, 'name_en' => 'Al-Housha', 'name_ar' => 'الحوشة'],
            ['city_id' => 5, 'name_en' => 'Al-Mughir', 'name_ar' => 'المغير'],
            ['city_id' => 5, 'name_en' => 'Sheikh Hussein', 'name_ar' => 'الشيخ حسين'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Hamam', 'name_ar' => 'خربة الحمام'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Jamal', 'name_ar' => 'خربة الجمل'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Kurdi', 'name_ar' => 'خربة الكردي'],
            ['city_id' => 5, 'name_en' => 'Balaama (Al-Liwa Center)', 'name_ar' => 'بلعما (مركز اللواء)'],
            ['city_id' => 5, 'name_en' => 'Wusat Al-Balad', 'name_ar' => 'وسط البلد'],
            ['city_id' => 5, 'name_en' => 'Al-Jabal Al-Akhdar', 'name_ar' => 'الجبل الأخضر'],
            ['city_id' => 5, 'name_en' => 'Al-Madawir', 'name_ar' => 'المداوير'],
            ['city_id' => 5, 'name_en' => 'Al-Nuzha', 'name_ar' => 'النزهة'],
            ['city_id' => 5, 'name_en' => 'Al-Murajim', 'name_ar' => 'المراجم'],
            ['city_id' => 5, 'name_en' => 'Umm Suwayyina', 'name_ar' => 'أم صويوينة'],
            ['city_id' => 5, 'name_en' => 'Khirisan', 'name_ar' => 'خريسان'],
            ['city_id' => 5, 'name_en' => 'Al-Sharifiya', 'name_ar' => 'الشريفية'],
            ['city_id' => 5, 'name_en' => 'Hammanah', 'name_ar' => 'حمنانة'],
            ['city_id' => 5, 'name_en' => 'Al-Jabriya', 'name_ar' => 'الجابرية'],
            ['city_id' => 5, 'name_en' => 'Jabal Al-Hussein', 'name_ar' => 'جبل الحسين'],
            ['city_id' => 5, 'name_en' => 'Al-Hamra', 'name_ar' => 'الحمراء'],
            ['city_id' => 5, 'name_en' => 'Al-Manshiya', 'name_ar' => 'المنشية'],
            ['city_id' => 5, 'name_en' => 'Al-Khalidiya', 'name_ar' => 'الخالدية'],
            ['city_id' => 5, 'name_en' => 'Al-Manshiya', 'name_ar' => 'حي المنشية'],
            ['city_id' => 5, 'name_en' => 'Al-Amir Rashid', 'name_ar' => 'حي الأمير راشد'],
            ['city_id' => 5, 'name_en' => 'Al-Oyoun', 'name_ar' => 'حي العيون'],
            ['city_id' => 5, 'name_en' => 'Al-Majd', 'name_ar' => 'حي المجد'],
            ['city_id' => 5, 'name_en' => 'Al-Naseem', 'name_ar' => 'حي النسيم'],
            ['city_id' => 5, 'name_en' => 'Al-Iskan', 'name_ar' => 'حي الإسكان'],
            ['city_id' => 5, 'name_en' => 'Khurbet Owj', 'name_ar' => 'خربة عوج'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Mulaqqa', 'name_ar' => 'خربة المعلقة'],
            ['city_id' => 5, 'name_en' => 'Khurbet Sheikh Suleiman', 'name_ar' => 'خربة الشيخ سليمان'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Adas', 'name_ar' => 'خربة العدس'],
            ['city_id' => 5, 'name_en' => 'Al-Muraad', 'name_ar' => 'المعراض'],
            ['city_id' => 5, 'name_en' => 'Nabi Hud', 'name_ar' => 'النبي هود'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Zaytoun', 'name_ar' => 'خربة الزيتون'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Awaynd', 'name_ar' => 'خربة العويند'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Ruqad', 'name_ar' => 'خربة الرقاد'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Hassan', 'name_ar' => 'خربة الحسن'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Marwah', 'name_ar' => 'خربة المرو'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Sawan', 'name_ar' => 'خربة الصوان'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Shoubak', 'name_ar' => 'خربة الشوبك'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Nawafila', 'name_ar' => 'خربة النوافلة'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Zahr', 'name_ar' => 'خربة الزهر'],
            ['city_id' => 5, 'name_en' => 'Khurbet Al-Amaayir', 'name_ar' => 'خربة العماير'],
            // Jerash
            ['city_id' => 6, 'name_en' => 'Al-Hai Al-Sharqi', 'name_ar' => 'الحي الشرقي'],
            ['city_id' => 6, 'name_en' => 'Al-Hai Al-Gharbi', 'name_ar' => 'الحي الغربي'],
            ['city_id' => 6, 'name_en' => 'Downtown (Historical Area)', 'name_ar' => 'وسط المدينة (منطقة الأثار)'],
            ['city_id' => 6, 'name_en' => 'Al-Nazha', 'name_ar' => 'حي النزهة'],
            ['city_id' => 6, 'name_en' => 'Al-Rabiya', 'name_ar' => 'حي الرابية'],
            ['city_id' => 6, 'name_en' => 'Al-Zohour', 'name_ar' => 'حي الزهور'],
            ['city_id' => 6, 'name_en' => 'Al-Rawda', 'name_ar' => 'حي الروضة'],
            ['city_id' => 6, 'name_en' => 'Al-Muallimeen', 'name_ar' => 'حي المعلمين'],
            ['city_id' => 6, 'name_en' => 'Al-Jami’a', 'name_ar' => 'حي الجامعة'],
            ['city_id' => 6, 'name_en' => 'Al-Amir Rashid', 'name_ar' => 'حي الأمير راشد'],
            ['city_id' => 6, 'name_en' => 'Al-Majd', 'name_ar' => 'حي المجد'],
            ['city_id' => 6, 'name_en' => 'Al-Naseem', 'name_ar' => 'حي النسيم'],
            ['city_id' => 6, 'name_en' => 'Al-Iskan', 'name_ar' => 'حي الإسكان'],
            ['city_id' => 6, 'name_en' => 'Al-Matar', 'name_ar' => 'حي المطار'],
            ['city_id' => 6, 'name_en' => 'Al-Shalala', 'name_ar' => 'حي الشلال'],
            ['city_id' => 6, 'name_en' => 'Al-Manshiya', 'name_ar' => 'حي المنشية'],
            ['city_id' => 6, 'name_en' => 'Al-Safa', 'name_ar' => 'حي الصفا'],
            ['city_id' => 6, 'name_en' => 'Al-Jabarat', 'name_ar' => 'حي الجبارات'],
            ['city_id' => 6, 'name_en' => 'Jerash (Muzar)', 'name_ar' => 'جرش (مركز اللواء)'],
            ['city_id' => 6, 'name_en' => 'Suf', 'name_ar' => 'سوف'],
            ['city_id' => 6, 'name_en' => 'Sakib', 'name_ar' => 'ساكب'],
            ['city_id' => 6, 'name_en' => 'Kafr Khal', 'name_ar' => 'كفر خل'],
            ['city_id' => 6, 'name_en' => 'Al-Katta', 'name_ar' => 'الكتة'],
            ['city_id' => 6, 'name_en' => 'Ramon', 'name_ar' => 'ريمون'],
            ['city_id' => 6, 'name_en' => 'Bailaa', 'name_ar' => 'بليلا'],
            ['city_id' => 6, 'name_en' => 'Qafqafa', 'name_ar' => 'قفقفا'],
            ['city_id' => 6, 'name_en' => 'Nahila', 'name_ar' => 'نحلة'],
            ['city_id' => 6, 'name_en' => 'Al-Rabwa', 'name_ar' => 'الربوة'],
            ['city_id' => 6, 'name_en' => 'Deir Al-Layat', 'name_ar' => 'دير الليات'],
            ['city_id' => 6, 'name_en' => 'Al-Haddadah', 'name_ar' => 'الحداده'],
            ['city_id' => 6, 'name_en' => 'Muqabla', 'name_ar' => 'مقبله'],
            ['city_id' => 6, 'name_en' => 'Al-Kafir', 'name_ar' => 'الكفير'],
            ['city_id' => 6, 'name_en' => 'Zaqrit', 'name_ar' => 'زقريط'],
            ['city_id' => 6, 'name_en' => 'Al-Jabarat', 'name_ar' => 'الجبارات'],
            ['city_id' => 6, 'name_en' => 'Asfur', 'name_ar' => 'عصفور'],
            ['city_id' => 6, 'name_en' => 'Al-Rashaida', 'name_ar' => 'الرشايدة'],
            ['city_id' => 6, 'name_en' => 'Um Ramah', 'name_ar' => 'أم رامح'],
            ['city_id' => 6, 'name_en' => 'Aynibah', 'name_ar' => 'عنيبة'],
            ['city_id' => 6, 'name_en' => 'Jaba', 'name_ar' => 'جبا'],
            ['city_id' => 6, 'name_en' => 'Um Al-Zaytoun', 'name_ar' => 'أم الزيتون'],
            ['city_id' => 6, 'name_en' => 'Nabi Hud', 'name_ar' => 'النبي هود'],
            ['city_id' => 6, 'name_en' => 'Al-Husayniyat', 'name_ar' => 'الحسينيات'],
            ['city_id' => 6, 'name_en' => 'Um Qantara', 'name_ar' => 'أم قنطرة'],
            ['city_id' => 6, 'name_en' => 'Najda', 'name_ar' => 'نجدة'],
            ['city_id' => 6, 'name_en' => 'Al-Majr', 'name_ar' => 'المجر'],
            ['city_id' => 6, 'name_en' => 'Al-Abara', 'name_ar' => 'العبارة'],
            ['city_id' => 6, 'name_en' => 'Jumla', 'name_ar' => 'جملا'],
            ['city_id' => 6, 'name_en' => 'Qurai’', 'name_ar' => 'قريع'],
            ['city_id' => 6, 'name_en' => 'Dabeen', 'name_ar' => 'دبين'],
            ['city_id' => 6, 'name_en' => 'Al-Riyashi', 'name_ar' => 'الرياشي'],
            ['city_id' => 6, 'name_en' => 'Al-Haziya', 'name_ar' => 'الحازية'],
            ['city_id' => 6, 'name_en' => 'Amama', 'name_ar' => 'عمامة'],
            ['city_id' => 6, 'name_en' => 'Sheikh Hussein', 'name_ar' => 'الشيخ حسين'],
            ['city_id' => 6, 'name_en' => 'Khurbet Al-Souq', 'name_ar' => 'خربة السوق'],
            ['city_id' => 6, 'name_en' => 'Khurbet Al-Adas', 'name_ar' => 'خربة العدس'],
            ['city_id' => 6, 'name_en' => 'Khurbet Al-Shajara', 'name_ar' => 'خربة الشجرة'],
            ['city_id' => 6, 'name_en' => 'Khurbet Al-Manara', 'name_ar' => 'خربة المنارة'],
            ['city_id' => 6, 'name_en' => 'Prince Hamza Area', 'name_ar' => 'حي الأمير حمزة'],
            ['city_id' => 6, 'name_en' => 'Al-Amal Area', 'name_ar' => 'حي العمال'],
            ['city_id' => 6, 'name_en' => 'Al-Rihan Area', 'name_ar' => 'حي الريحان'],
            ['city_id' => 6, 'name_en' => 'Al-Tallah Area', 'name_ar' => 'حي التلة'],
            ['city_id' => 6, 'name_en' => 'Khurbet Al-Nakhl', 'name_ar' => 'خربة النخل'],
            ['city_id' => 6, 'name_en' => 'Khurbet Al-Zaytoun', 'name_ar' => 'خربة الزيتون'],
            ['city_id' => 6, 'name_en' => 'Khurbet Al-Maro', 'name_ar' => 'خربة المرو'],
            ['city_id' => 6, 'name_en' => 'Khurbet Al-Sawan', 'name_ar' => 'خربة الصوان'],
            ['city_id' => 6, 'name_en' => 'Umm Al-Kharab', 'name_ar' => 'أم الخراب'],
            ['city_id' => 6, 'name_en' => 'Al-Safi', 'name_ar' => 'الصفيح'],
            ['city_id' => 6, 'name_en' => 'Khurbet Sheikh Muhammad', 'name_ar' => 'خربة الشيخ محمد'],
            ['city_id' => 6, 'name_en' => 'Khurbet Al-Ain', 'name_ar' => 'خربة العين'],
            // madaba
            ['city_id' => 7, 'name_en' => 'Al-Jarneh', 'name_ar' => 'حي جرينة'],
            ['city_id' => 7, 'name_en' => 'Al-Wusiah', 'name_ar' => 'حي الوسية'],
            ['city_id' => 7, 'name_en' => 'Al-Nazha', 'name_ar' => 'حي النزهة'],
            ['city_id' => 7, 'name_en' => 'Al-Rayhan', 'name_ar' => 'حي الريحان'],
            ['city_id' => 7, 'name_en' => 'Al-Ghernata', 'name_ar' => 'حي غرناطة'],
            ['city_id' => 7, 'name_en' => 'Al-Areesh', 'name_ar' => 'حي العريش'],
            ['city_id' => 7, 'name_en' => 'Al-Zahra', 'name_ar' => 'حي الزهراء'],
            ['city_id' => 7, 'name_en' => 'Al-Safa', 'name_ar' => 'حي الصفا'],
            ['city_id' => 7, 'name_en' => 'Ma\'in', 'name_ar' => 'حي ماعين'],
            ['city_id' => 7, 'name_en' => 'Al-Manshiya', 'name_ar' => 'حي المنشية'],
            ['city_id' => 7, 'name_en' => 'Al-Rawda', 'name_ar' => 'حي الروضة'],
            ['city_id' => 7, 'name_en' => 'Al-Salam', 'name_ar' => 'حي السلام'],
            ['city_id' => 7, 'name_en' => 'Al-Faisaliah', 'name_ar' => 'حي الفيصلية'],
            ['city_id' => 7, 'name_en' => 'Al-Zuhur', 'name_ar' => 'حي الزهور'],
            ['city_id' => 7, 'name_en' => 'Al-Murouj', 'name_ar' => 'حي المروج'],
            ['city_id' => 7, 'name_en' => 'Al-Ayoun', 'name_ar' => 'حي العيون'],
            ['city_id' => 7, 'name_en' => 'Al-Murajimat', 'name_ar' => 'حي المريجمات'],
            ['city_id' => 7, 'name_en' => 'Al-Hawiya', 'name_ar' => 'حي الحوية'],
            ['city_id' => 7, 'name_en' => 'Al-Jabarat', 'name_ar' => 'حي الجبارات'],
            ['city_id' => 7, 'name_en' => 'Prince Hamza', 'name_ar' => 'حي الأمير حمزة'],
            ['city_id' => 7, 'name_en' => 'Madaba', 'name_ar' => 'مادبا'],
            ['city_id' => 7, 'name_en' => 'Eastern Neighborhood', 'name_ar' => 'الحي الشرقي'],
            ['city_id' => 7, 'name_en' => 'Western Neighborhood', 'name_ar' => 'الحي الغربي'],
            ['city_id' => 7, 'name_en' => 'Umm Al-Rasas', 'name_ar' => 'أم الرصاص'],
            ['city_id' => 7, 'name_en' => 'Al-Juhair', 'name_ar' => 'الجحير'],
            ['city_id' => 7, 'name_en' => 'Al-Nuqayrah', 'name_ar' => 'النقيرة'],
            ['city_id' => 7, 'name_en' => 'Khurbet Sheikh Mohammed', 'name_ar' => 'خربة الشيخ محمد'],
            ['city_id' => 7, 'name_en' => 'Khurbet Al-Ayn', 'name_ar' => 'خربة العين'],
            ['city_id' => 7, 'name_en' => 'Khurbet Al-Zaytoun', 'name_ar' => 'خربة الزيتون'],
            ['city_id' => 7, 'name_en' => 'Khurbet Al-Nakhl', 'name_ar' => 'خربة النخل'],
            ['city_id' => 7, 'name_en' => 'Khurbet Al-Sawan', 'name_ar' => 'خربة الصوان'],
            ['city_id' => 7, 'name_en' => 'Umm Al-Kharab', 'name_ar' => 'أم الخراب'],
            ['city_id' => 7, 'name_en' => 'Al-Safih', 'name_ar' => 'الصفيح'],
            ['city_id' => 7, 'name_en' => 'Al-Muheet', 'name_ar' => 'المحيط'],
            ['city_id' => 7, 'name_en' => 'Al-Khuneizirah', 'name_ar' => 'الخنيزرة'],
            ['city_id' => 7, 'name_en' => 'Al-Faiha', 'name_ar' => 'الفيحاء'],
            ['city_id' => 7, 'name_en' => 'Al-Ruqaym', 'name_ar' => 'الرقيم'],
            ['city_id' => 7, 'name_en' => 'Dheban', 'name_ar' => 'ذيبان'],
            ['city_id' => 7, 'name_en' => 'Al-Ayn Al-Bayda', 'name_ar' => 'العين البيضاء'],
            ['city_id' => 7, 'name_en' => 'Khurbet Al-Deir', 'name_ar' => 'خربة الدير'],
            ['city_id' => 7, 'name_en' => 'Khurbet Al-Namira', 'name_ar' => 'خربة النميرة'],
            ['city_id' => 7, 'name_en' => 'Khurbet Sheikh Issa', 'name_ar' => 'خربة الشيخ عيسى'],
            ['city_id' => 7, 'name_en' => 'Khurbet Al-Manara', 'name_ar' => 'خربة المنارة'],
            ['city_id' => 7, 'name_en' => 'Al-Ruwayha', 'name_ar' => 'الرويحة'],
            ['city_id' => 7, 'name_en' => 'Al-Musharifa', 'name_ar' => 'المشيرفة'],
            ['city_id' => 7, 'name_en' => 'Al-Fakhour', 'name_ar' => 'الفاخور'],
            ['city_id' => 7, 'name_en' => 'Al-Arjah', 'name_ar' => 'العرجة'],
            ['city_id' => 7, 'name_en' => 'Al-Sulayhi', 'name_ar' => 'السليحي'],
            ['city_id' => 7, 'name_en' => 'Al-Ma\'mariya', 'name_ar' => 'المعمرية'],
            ['city_id' => 7, 'name_en' => 'Al-Jazazah', 'name_ar' => 'الجزازة'],
            ['city_id' => 7, 'name_en' => 'Ma\'in', 'name_ar' => 'ماعين'],
            ['city_id' => 7, 'name_en' => 'Hammamat Ma\'in', 'name_ar' => 'حمامات ماعين'],
            ['city_id' => 7, 'name_en' => 'Al-Makawir', 'name_ar' => 'المكاور'],
            ['city_id' => 7, 'name_en' => 'Ayoun Musa', 'name_ar' => 'عيون موسى'],
            ['city_id' => 7, 'name_en' => 'Umm Zighyo', 'name_ar' => 'أم زغيو'],
            ['city_id' => 7, 'name_en' => 'Khurbet Al-Abd', 'name_ar' => 'خربة العبد'],
            ['city_id' => 7, 'name_en' => 'Khurbet Al-Madur', 'name_ar' => 'خربة المدور'],
            ['city_id' => 7, 'name_en' => 'Khurbet Al-Saad', 'name_ar' => 'خربة السعد'],
            ['city_id' => 7, 'name_en' => 'Al-Zara', 'name_ar' => 'الزراع'],
            ['city_id' => 7, 'name_en' => 'Al-Nahda', 'name_ar' => 'النهضة'],
            ['city_id' => 7, 'name_en' => 'Al-Haditha', 'name_ar' => 'الحديثة'],
            ['city_id' => 7, 'name_en' => 'Al-Riyad', 'name_ar' => 'الرياض'],
            // karak
            ['city_id' => 8, 'name_en' => 'Eastern Area', 'name_ar' => 'الحي الشرقي'],
            ['city_id' => 8, 'name_en' => 'Western Area', 'name_ar' => 'الحي الغربي'],
            ['city_id' => 8, 'name_en' => 'City Center (Qalaat Al-Karak)', 'name_ar' => 'وسط المدينة (منطقة قلعة الكرك)'],
            ['city_id' => 8, 'name_en' => 'Al-Nuzha Area', 'name_ar' => 'حي النزهة'],
            ['city_id' => 8, 'name_en' => 'Al-Rabiah Area', 'name_ar' => 'حي الرابية'],
            ['city_id' => 8, 'name_en' => 'Al-Zuhur Area', 'name_ar' => 'حي الزهور'],
            ['city_id' => 8, 'name_en' => 'Al-Rawda Area', 'name_ar' => 'حي الروضة'],
            ['city_id' => 8, 'name_en' => 'Al-Muallimeen Area', 'name_ar' => 'حي المعلمين'],
            ['city_id' => 8, 'name_en' => 'University Area', 'name_ar' => 'حي الجامعة'],
            ['city_id' => 8, 'name_en' => 'Prince Rashid Area', 'name_ar' => 'حي الأمير راشد'],
            ['city_id' => 8, 'name_en' => 'Al-Majd Area', 'name_ar' => 'حي المجد'],
            ['city_id' => 8, 'name_en' => 'Al-Naseem Area', 'name_ar' => 'حي النسيم'],
            ['city_id' => 8, 'name_en' => 'Al-Iskan Area', 'name_ar' => 'حي الإسكان'],
            ['city_id' => 8, 'name_en' => 'Al-Shallal Area', 'name_ar' => 'حي الشلال'],
            ['city_id' => 8, 'name_en' => 'Al-Manshiya Area', 'name_ar' => 'حي المنشية'],
            ['city_id' => 8, 'name_en' => 'Al-Safa Area', 'name_ar' => 'حي الصفا'],
            ['city_id' => 8, 'name_en' => 'Al-Jabbarat Area', 'name_ar' => 'حي الجبارات'],
            ['city_id' => 8, 'name_en' => 'Al-Amal Area', 'name_ar' => 'حي العمال'],
            ['city_id' => 8, 'name_en' => 'Prince Hamza Area', 'name_ar' => 'حي الأمير حمزة'],
            ['city_id' => 8, 'name_en' => 'Al-Talah Area', 'name_ar' => 'حي التلة'],
            ['city_id' => 8, 'name_en' => 'Karak (Center)', 'name_ar' => 'الكرك (مركز اللواء)'],
            ['city_id' => 8, 'name_en' => 'Adir', 'name_ar' => 'ادر'],
            ['city_id' => 8, 'name_en' => 'Shahabiyah', 'name_ar' => 'الشهابية'],
            ['city_id' => 8, 'name_en' => 'Manshiya Abu Hamour', 'name_ar' => 'منشية ابو حمور'],
            ['city_id' => 8, 'name_en' => 'Al-Jadida', 'name_ar' => 'الجديدة'],
            ['city_id' => 8, 'name_en' => 'Rakin', 'name_ar' => 'راكين'],
            ['city_id' => 8, 'name_en' => 'Al-Adnaniyah', 'name_ar' => 'العدنانية'],
            ['city_id' => 8, 'name_en' => 'Al-Thaniya', 'name_ar' => 'الثنية'],
            ['city_id' => 8, 'name_en' => 'Bater', 'name_ar' => 'بتير'],
            ['city_id' => 8, 'name_en' => 'Al-Ghweir', 'name_ar' => 'الغوير'],
            ['city_id' => 8, 'name_en' => 'Madin', 'name_ar' => 'مدين'],
            ['city_id' => 8, 'name_en' => 'Samra', 'name_ar' => 'سمرا'],
            ['city_id' => 8, 'name_en' => 'Maroud', 'name_ar' => 'مرود'],
            ['city_id' => 8, 'name_en' => 'Bithan and Burda', 'name_ar' => 'بذان وبردى'],
            ['city_id' => 8, 'name_en' => 'Al-Buqay', 'name_ar' => 'البقيع'],
            ['city_id' => 8, 'name_en' => 'Zahum', 'name_ar' => 'زحوم'],
            ['city_id' => 8, 'name_en' => 'Al-Musharifa', 'name_ar' => 'المشيرفه'],
            ['city_id' => 8, 'name_en' => 'Aynoun', 'name_ar' => 'عينون'],
            ['city_id' => 8, 'name_en' => 'Momiya', 'name_ar' => 'موميا'],
            ['city_id' => 8, 'name_en' => 'Wadi Ibn Hammad', 'name_ar' => 'وادي ابن حماد'],
            ['city_id' => 8, 'name_en' => 'Ska', 'name_ar' => 'سكا'],
            ['city_id' => 8, 'name_en' => 'Al-Rashidiya', 'name_ar' => 'الراشديه'],
            ['city_id' => 8, 'name_en' => 'Al-Wasiya', 'name_ar' => 'الوسيه'],
            ['city_id' => 8, 'name_en' => 'Al-Mamonia', 'name_ar' => 'المامونية'],
            ['city_id' => 8, 'name_en' => 'Al-Salihiya', 'name_ar' => 'الصالحية'],
            ['city_id' => 8, 'name_en' => 'Al-Mahmudiya', 'name_ar' => 'المحمودية'],
            ['city_id' => 8, 'name_en' => 'Umm Ramana', 'name_ar' => 'ام رمانة'],
            ['city_id' => 8, 'name_en' => 'Al-Aziziya', 'name_ar' => 'العزيزية'],
            ['city_id' => 8, 'name_en' => 'Al-Abbasiya', 'name_ar' => 'العباسية'],
            ['city_id' => 8, 'name_en' => 'Al-Abdaliya', 'name_ar' => 'العبدلية'],
            ['city_id' => 8, 'name_en' => 'Al-Lajun', 'name_ar' => 'اللجون'],
            ['city_id' => 8, 'name_en' => 'Qaryfala', 'name_ar' => 'قريفله'],
            ['city_id' => 8, 'name_en' => 'Al-Hawayeh', 'name_ar' => 'الحويه'],
            ['city_id' => 8, 'name_en' => 'Kamlah', 'name_ar' => 'كمله'],
            ['city_id' => 8, 'name_en' => 'Al-Qasr (Center)', 'name_ar' => 'القصر (مركز اللواء)'],
            ['city_id' => 8, 'name_en' => 'Rabah', 'name_ar' => 'ربة'],
            ['city_id' => 8, 'name_en' => 'Tufaih', 'name_ar' => 'طفيح'],
            ['city_id' => 8, 'name_en' => 'Atruz', 'name_ar' => 'عطروز'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Mujib', 'name_ar' => 'خربة الموجب'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Der', 'name_ar' => 'خربة الدير'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Ain', 'name_ar' => 'خربة العين'],
            ['city_id' => 8, 'name_en' => 'Al-Mazar Al-Janoubi (Center)', 'name_ar' => 'المزار الجنوبي (مركز اللواء)'],
            ['city_id' => 8, 'name_en' => 'Al-Karama', 'name_ar' => 'الكرامة'],
            ['city_id' => 8, 'name_en' => 'Al-Taybah', 'name_ar' => 'الطيبة'],
            ['city_id' => 8, 'name_en' => 'Dhiban', 'name_ar' => 'ذيبان'],
            ['city_id' => 8, 'name_en' => 'Al-Haditha', 'name_ar' => 'الحديثة'],
            ['city_id' => 8, 'name_en' => 'Al-Sultani', 'name_ar' => 'السلطاني'],
            ['city_id' => 8, 'name_en' => 'Umm Zaarour', 'name_ar' => 'أم زعرور'],
            ['city_id' => 8, 'name_en' => 'Khurbet Sheikh Issa', 'name_ar' => 'خربة الشيخ عيسى'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Nimrah', 'name_ar' => 'خربة النميرة'],
            ['city_id' => 8, 'name_en' => 'Ghor Al-Mazra\'ah (Center)', 'name_ar' => 'غور المزرعة (مركز اللواء)'],
            ['city_id' => 8, 'name_en' => 'Ghor Al-Safi', 'name_ar' => 'غور الصافي'],
            ['city_id' => 8, 'name_en' => 'Ghor Fifa', 'name_ar' => 'غور فيفا'],
            ['city_id' => 8, 'name_en' => 'Ghor Al-Naq\'a', 'name_ar' => 'غور النقع'],
            ['city_id' => 8, 'name_en' => 'Ghor Adas', 'name_ar' => 'غور عدس'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Zira\'a', 'name_ar' => 'خربة الزراع'],
            ['city_id' => 8, 'name_en' => 'Ai (Center)', 'name_ar' => 'عي (مركز اللواء)'],
            ['city_id' => 8, 'name_en' => 'Fantas', 'name_ar' => 'فنطس'],
            ['city_id' => 8, 'name_en' => 'Jaloul', 'name_ar' => 'جلول'],
            ['city_id' => 8, 'name_en' => 'Manshiya Al-Sultan', 'name_ar' => 'منشية السلطان'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Rusayfa', 'name_ar' => 'خربة الرصيفة'],
            ['city_id' => 8, 'name_en' => 'Al-Fakhouri (Center)', 'name_ar' => 'الفاخوري (مركز اللواء)'],
            ['city_id' => 8, 'name_en' => 'Al-Mujib', 'name_ar' => 'الموجب'],
            ['city_id' => 8, 'name_en' => 'Al-Dabbab', 'name_ar' => 'الدباب'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Mador', 'name_ar' => 'خربة المدور'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Saad', 'name_ar' => 'خربة السعد'],
            ['city_id' => 8, 'name_en' => 'Al-Qatraneh (Center)', 'name_ar' => 'القطرانة (مركز اللواء)'],
            ['city_id' => 8, 'name_en' => 'Hasban', 'name_ar' => 'حسبان'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Haj Hassan', 'name_ar' => 'خربة الحاج حسن'],
            ['city_id' => 8, 'name_en' => 'Khurbet Sheikh Suleiman', 'name_ar' => 'خربة الشيخ سليمان'],
            ['city_id' => 8, 'name_en' => 'Al-Hasa (Center)', 'name_ar' => 'الحسا (مركز اللواء)'],
            ['city_id' => 8, 'name_en' => 'Al-Murqab', 'name_ar' => 'المرقب'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Abd', 'name_ar' => 'خربة العبد'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Nuwirat', 'name_ar' => 'خربة النويرات'],
            ['city_id' => 8, 'name_en' => 'Al-Rayhan', 'name_ar' => 'حي الريحان'],
            ['city_id' => 8, 'name_en' => 'Al-Ayoun', 'name_ar' => 'حي العيون'],
            ['city_id' => 8, 'name_en' => 'Al-Murouj', 'name_ar' => 'حي المروج'],
            ['city_id' => 8, 'name_en' => 'Al-Salam', 'name_ar' => 'حي السلام'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Zaytoun', 'name_ar' => 'خربة الزيتون'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Nakhl', 'name_ar' => 'خربة النخل'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Sawan', 'name_ar' => 'خربة الصوان'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Maro', 'name_ar' => 'خربة المرو'],
            ['city_id' => 8, 'name_en' => 'Umm Al-Kharab', 'name_ar' => 'أم الخراب'],
            ['city_id' => 8, 'name_en' => 'Khurbet Sheikh Mohammed', 'name_ar' => 'خربة الشيخ محمد'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Noor', 'name_ar' => 'خربة النور'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Ayn', 'name_ar' => 'خربة العين'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Zahr', 'name_ar' => 'خربة الزهر'],
            ['city_id' => 8, 'name_en' => 'Khurbet Sheikh Hussein', 'name_ar' => 'خربة الشيخ حسين'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Manara', 'name_ar' => 'خربة المنارة'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Abd', 'name_ar' => 'خربة العبد'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Ain Al-Bayda', 'name_ar' => 'خربة العين البيضاء'],
            ['city_id' => 8, 'name_en' => 'Khurbet Sheikh Issa', 'name_ar' => 'خربة الشيخ عيسى'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Manara', 'name_ar' => 'خربة المنارة'],
            ['city_id' => 8, 'name_en' => 'Khurbet Sheikh Suleiman', 'name_ar' => 'خربة الشيخ سليمان'],
            ['city_id' => 8, 'name_en' => 'Khurbet Al-Ain', 'name_ar' => 'خربة العين'],
            // Tafila
            ['city_id' => 9, 'name_en' => 'City Center', 'name_ar' => 'وسط المدينة'],
            ['city_id' => 9, 'name_en' => 'Al-Nuzha', 'name_ar' => 'حي النزهة'],
            ['city_id' => 9, 'name_en' => 'Al-Zahra', 'name_ar' => 'حي الزهراء'],
            ['city_id' => 9, 'name_en' => 'Al-Rawda', 'name_ar' => 'حي الروضة'],
            ['city_id' => 9, 'name_en' => 'Al-Ays', 'name_ar' => 'حي العيص'],
            ['city_id' => 9, 'name_en' => 'Al-Rihhan', 'name_ar' => 'حي الريحان'],
            ['city_id' => 9, 'name_en' => 'Al-Safa', 'name_ar' => 'حي الصفا'],
            ['city_id' => 9, 'name_en' => 'Al-Ayn Al-Bayda', 'name_ar' => 'حي العين البيضاء'],
            ['city_id' => 9, 'name_en' => 'Al-Zohour', 'name_ar' => 'حي الزهور'],
            ['city_id' => 9, 'name_en' => 'Al-Muruj', 'name_ar' => 'حي المروج'],
            ['city_id' => 9, 'name_en' => 'Al-Hussein', 'name_ar' => 'حي الحسين'],
            ['city_id' => 9, 'name_en' => 'Al-Manashia', 'name_ar' => 'حي المنشية'],
            ['city_id' => 9, 'name_en' => 'Al-Oyoun', 'name_ar' => 'حي العيون'],
            ['city_id' => 9, 'name_en' => 'Aima', 'name_ar' => 'حي عيمة'],
            ['city_id' => 9, 'name_en' => 'Al-Jabarat', 'name_ar' => 'حي الجبارات'],
            ['city_id' => 9, 'name_en' => 'Prince Hamza', 'name_ar' => 'حي الأمير حمزة'],
            ['city_id' => 9, 'name_en' => 'Tafila', 'name_ar' => 'الطفيلة'],
            ['city_id' => 9, 'name_en' => 'Al-Ays', 'name_ar' => 'العيص'],
            ['city_id' => 9, 'name_en' => 'Al-Ayn Al-Bayda', 'name_ar' => 'العين البيضاء'],
            ['city_id' => 9, 'name_en' => 'Al-Hussein', 'name_ar' => 'الحسين'],
            ['city_id' => 9, 'name_en' => 'Aima', 'name_ar' => 'عيمة'],
            ['city_id' => 9, 'name_en' => 'Al-Murqab', 'name_ar' => 'المرقب'],
            ['city_id' => 9, 'name_en' => 'Al-Qadisia', 'name_ar' => 'القادسية'],
            ['city_id' => 9, 'name_en' => 'Al-Rushadiya', 'name_ar' => 'الرشادية'],
            ['city_id' => 9, 'name_en' => 'Al-Jawabra', 'name_ar' => 'الجوابرة'],
            ['city_id' => 9, 'name_en' => 'Umm Al-Amad', 'name_ar' => 'أم العمد'],
            ['city_id' => 9, 'name_en' => 'Khurbet Sheikh Mohammad', 'name_ar' => 'خربة الشيخ محمد'],
            ['city_id' => 9, 'name_en' => 'Khurbet Al-Ayn', 'name_ar' => 'خربة العين'],
            ['city_id' => 9, 'name_en' => 'Khurbet Al-Zaytoun', 'name_ar' => 'خربة الزيتون'],
            ['city_id' => 9, 'name_en' => 'Khurbet Al-Nakhl', 'name_ar' => 'خربة النخل'],
            ['city_id' => 9, 'name_en' => 'Khurbet Al-Sawan', 'name_ar' => 'خربة الصوان'],
            ['city_id' => 9, 'name_en' => 'Umm Al-Kharab', 'name_ar' => 'أم الخراب'],
            ['city_id' => 9, 'name_en' => 'As-Safi', 'name_ar' => 'الصفيح'],
            ['city_id' => 9, 'name_en' => 'As-Sala', 'name_ar' => 'السلع'],
            ['city_id' => 9, 'name_en' => 'Al-Bari', 'name_ar' => 'البري'],
            ['city_id' => 9, 'name_en' => 'Al-Matan', 'name_ar' => 'المعطان'],
            ['city_id' => 9, 'name_en' => 'Al-Ruwaida', 'name_ar' => 'الروييدة'],
            ['city_id' => 9, 'name_en' => 'Al-Janineh', 'name_ar' => 'الجنينة'],
            ['city_id' => 9, 'name_en' => 'Al-Zahum', 'name_ar' => 'الزحوم'],
            ['city_id' => 9, 'name_en' => 'Al-Bayda', 'name_ar' => 'البيضاء'],
            ['city_id' => 9, 'name_en' => 'Al-Qal’a', 'name_ar' => 'القلعة'],
            ['city_id' => 9, 'name_en' => 'Al-Jurf', 'name_ar' => 'الجرف'],
            ['city_id' => 9, 'name_en' => 'Al-Rahma', 'name_ar' => 'الرحمة'],
            ['city_id' => 9, 'name_en' => 'Al-Mansoura', 'name_ar' => 'المنصورة'],
            ['city_id' => 9, 'name_en' => 'Al-Hasa', 'name_ar' => 'الحسا (مركز اللواء)'],
            ['city_id' => 9, 'name_en' => 'Khurbet Al-Abed', 'name_ar' => 'خربة العبد'],
            ['city_id' => 9, 'name_en' => 'Khurbet Al-Nwayrat', 'name_ar' => 'خربة النويرات'],
            ['city_id' => 9, 'name_en' => 'Al-Basira', 'name_ar' => 'البصيرة (مركز اللواء)'],
            ['city_id' => 9, 'name_en' => 'Dana', 'name_ar' => 'ضانا'],
            ['city_id' => 9, 'name_en' => 'Al-Rajaf', 'name_ar' => 'الراجف'],
            ['city_id' => 9, 'name_en' => 'Ain Al-Zarqa', 'name_ar' => 'عين الزرقاء'],
            ['city_id' => 9, 'name_en' => 'Al-Musharifa', 'name_ar' => 'المشيرفة'],
            ['city_id' => 9, 'name_en' => 'Al-Qasr', 'name_ar' => 'القصر'],
            ['city_id' => 9, 'name_en' => 'Khurbet Al-Deir', 'name_ar' => 'خربة الدير'],
            ['city_id' => 9, 'name_en' => 'Khurbet Sheikh Issa', 'name_ar' => 'خربة الشيخ عيسى'],
            ['city_id' => 9, 'name_en' => 'Khurbet Al-Manara', 'name_ar' => 'خربة المنارة'],
            ['city_id' => 9, 'name_en' => 'Khurbet Al-Saad', 'name_ar' => 'خربة السعد'],
            ['city_id' => 9, 'name_en' => 'Umm Qaseer', 'name_ar' => 'أم قصير'],
            ['city_id' => 9, 'name_en' => 'Al-Muraygha', 'name_ar' => 'المريغة'],
            ['city_id' => 9, 'name_en' => 'Al-Tan’eem', 'name_ar' => 'التنعيم'],
            // Balqa
            ['city_id' => 10, 'name_en' => 'Downtown', 'name_ar' => 'وسط المدينة'],
            ['city_id' => 10, 'name_en' => 'Al-Hammam', 'name_ar' => 'حي الحمام'],
            ['city_id' => 10, 'name_en' => 'Al-Midan', 'name_ar' => 'حي الميدان'],
            ['city_id' => 10, 'name_en' => 'Al-Khudr', 'name_ar' => 'حي الخضر'],
            ['city_id' => 10, 'name_en' => 'Al-Nuzha', 'name_ar' => 'حي النزهة'],
            ['city_id' => 10, 'name_en' => 'Al-Zahra', 'name_ar' => 'حي الزهراء'],
            ['city_id' => 10, 'name_en' => 'Al-Rawda', 'name_ar' => 'حي الروضة'],
            ['city_id' => 10, 'name_en' => 'Al-Safa', 'name_ar' => 'حي الصفا'],
            ['city_id' => 10, 'name_en' => 'Al-Raihan', 'name_ar' => 'حي الريحان'],
            ['city_id' => 10, 'name_en' => 'Al-Murooj', 'name_ar' => 'حي المروج'],
            ['city_id' => 10, 'name_en' => 'Al-Ayoun', 'name_ar' => 'حي العيون'],
            ['city_id' => 10, 'name_en' => 'Al-Jubarat', 'name_ar' => 'حي الجبارات'],
            ['city_id' => 10, 'name_en' => 'Prince Hamza', 'name_ar' => 'حي الأمير حمزة'],
            ['city_id' => 10, 'name_en' => 'Al-Manshiya', 'name_ar' => 'حي المنشية'],
            ['city_id' => 10, 'name_en' => 'Al-Zuhur', 'name_ar' => 'حي الزهور'],
            ['city_id' => 10, 'name_en' => 'Al-Salam', 'name_ar' => 'حي السلام'],
            ['city_id' => 10, 'name_en' => 'Al-Fuhis', 'name_ar' => 'الفحيص'],
            ['city_id' => 10, 'name_en' => 'Mahis', 'name_ar' => 'ماحص'],
            ['city_id' => 10, 'name_en' => 'Rama', 'name_ar' => 'الرامة'],
            ['city_id' => 10, 'name_en' => 'Al-Yaduda', 'name_ar' => 'اليادودة'],
            ['city_id' => 10, 'name_en' => 'Khurbet Al-Sheikh Mohammad', 'name_ar' => 'خربة الشيخ محمد'],
            ['city_id' => 10, 'name_en' => 'Khurbet Al-Ain', 'name_ar' => 'خربة العين'],
            ['city_id' => 10, 'name_en' => 'Khurbet Al-Zeitoun', 'name_ar' => 'خربة الزيتون'],
            ['city_id' => 10, 'name_en' => 'Khurbet Al-Nakhl', 'name_ar' => 'خربة النخل'],
            ['city_id' => 10, 'name_en' => 'Khurbet Al-Suwan', 'name_ar' => 'خربة الصوان'],
            ['city_id' => 10, 'name_en' => 'Um Al-Kharab', 'name_ar' => 'أم الخراب'],
            ['city_id' => 10, 'name_en' => 'Al-Saffih', 'name_ar' => 'الصفيح'],
            ['city_id' => 10, 'name_en' => 'Al-Aridah', 'name_ar' => 'العارضة'],
            ['city_id' => 10, 'name_en' => 'Al-Ruwaida', 'name_ar' => 'الرويحة'],
            ['city_id' => 10, 'name_en' => 'Al-Suwama', 'name_ar' => 'السويمة'],
            ['city_id' => 10, 'name_en' => 'Al-Juhair', 'name_ar' => 'الجحير'],
            ['city_id' => 10, 'name_en' => 'Um Jofa', 'name_ar' => 'أم جوفة'],
            ['city_id' => 10, 'name_en' => 'Zi', 'name_ar' => 'زي'],
            ['city_id' => 10, 'name_en' => 'Al-Ramimin', 'name_ar' => 'الرميمين'],
            ['city_id' => 10, 'name_en' => 'Al-Rabahia', 'name_ar' => 'الرباحية'],
            ['city_id' => 10, 'name_en' => 'Al-Dabbab', 'name_ar' => 'الدباب'],
            ['city_id' => 10, 'name_en' => 'Ain Al-Basha', 'name_ar' => 'عين الباشا'],
            ['city_id' => 10, 'name_en' => 'Baqa Refugee Camp', 'name_ar' => 'مخيم البقعة'],
            ['city_id' => 10, 'name_en' => 'Prince Ali', 'name_ar' => 'حي الأمير علي'],
            ['city_id' => 10, 'name_en' => 'Qutayba', 'name_ar' => 'حي قتيبة'],
            ['city_id' => 10, 'name_en' => 'Al-Balad', 'name_ar' => 'حي البلد'],
            ['city_id' => 10, 'name_en' => 'Al-Zahra', 'name_ar' => 'حي الزهراء'],
            ['city_id' => 10, 'name_en' => 'Um Sufatin', 'name_ar' => 'حي أم صفاتين'],
            ['city_id' => 10, 'name_en' => 'Al-Shuwaihi Al-Gharbi', 'name_ar' => 'حي الشويحي الغربي'],
            ['city_id' => 10, 'name_en' => 'Imam Al-Shafi\'i', 'name_ar' => 'حي الإمام الشافعي'],
            ['city_id' => 10, 'name_en' => 'Khurbet Al-Deir', 'name_ar' => 'خربة الدير'],
            ['city_id' => 10, 'name_en' => 'Khurbet Sheikh Issa', 'name_ar' => 'خربة الشيخ عيسى'],
            ['city_id' => 10, 'name_en' => 'Khurbet Al-Manara', 'name_ar' => 'خربة المنارة'],
            ['city_id' => 10, 'name_en' => 'Al-Shouna Al-Shamaliya', 'name_ar' => 'الشونة الشمالية'],
            ['city_id' => 10, 'name_en' => 'Al-Rihab', 'name_ar' => 'الرحاب'],
            ['city_id' => 10, 'name_en' => 'Al-Twal', 'name_ar' => 'الطوال'],
            ['city_id' => 10, 'name_en' => 'Al-Muqar', 'name_ar' => 'الموقر'],
            ['city_id' => 10, 'name_en' => 'Khurbet Al-Saad', 'name_ar' => 'خربة السعد'],
            ['city_id' => 10, 'name_en' => 'Khurbet Al-Abed', 'name_ar' => 'خربة العبد'],
            ['city_id' => 10, 'name_en' => 'Al-Jadida', 'name_ar' => 'الجديدة'],
            ['city_id' => 10, 'name_en' => 'Al-Nasr', 'name_ar' => 'النصر'],
            ['city_id' => 10, 'name_en' => 'Al-Ruwaishid', 'name_ar' => 'الرويشد'],
            ['city_id' => 10, 'name_en' => 'Deir Alla', 'name_ar' => 'دير علا (مركز اللواء)'],
            ['city_id' => 10, 'name_en' => 'Abu Zaygan', 'name_ar' => 'أبو زيغان'],
            ['city_id' => 10, 'name_en' => 'Abu Nasir', 'name_ar' => 'أبو نصير'],
            ['city_id' => 10, 'name_en' => 'Al-Adasiya', 'name_ar' => 'العدسية'],
            ['city_id' => 10, 'name_en' => 'Sheikh Hussein Village', 'name_ar' => 'بلدة الشيخ حسين'],
            ['city_id' => 10, 'name_en' => 'Khurbet Al-Namera', 'name_ar' => 'خربة النميرة'],
            ['city_id' => 10, 'name_en' => 'Khurbet Al-Madur', 'name_ar' => 'خربة المدور'],
            ['city_id' => 10, 'name_en' => 'Al-Maadi', 'name_ar' => 'المعاضي'],
            ['city_id' => 10, 'name_en' => 'Al-Manshiya', 'name_ar' => 'المنشية'],
            ['city_id' => 10, 'name_en' => 'Shuna Al-Janubiya', 'name_ar' => 'الشونة الجنوبية (مركز اللواء)'],
            ['city_id' => 10, 'name_en' => 'Al-Karama', 'name_ar' => 'الكرامة'],
            ['city_id' => 10, 'name_en' => 'Al-Ghazawiya', 'name_ar' => 'الغزاوية'],
            ['city_id' => 10, 'name_en' => 'Khurbet Sheikh Hussein', 'name_ar' => 'خربة الشيخ حسين'],
            ['city_id' => 10, 'name_en' => 'Khurbet Al-Ayn Al-Bayda', 'name_ar' => 'خربة العين البيضاء'],
            ['city_id' => 10, 'name_en' => 'Khurbet Al-Nwayrat', 'name_ar' => 'خربة النويرات'],
            ['city_id' => 10, 'name_en' => 'Al-Mushairih', 'name_ar' => 'المشيريع'],
            ['city_id' => 10, 'name_en' => 'Al-Naima', 'name_ar' => 'النعيمة'],
            // Ajloun
            ['city_id' => 11, 'name_en' => 'Downtown', 'name_ar' => 'وسط المدينة'],
            ['city_id' => 11, 'name_en' => 'Al-Qalaa', 'name_ar' => 'حي القلعة'],
            ['city_id' => 11, 'name_en' => 'Al-Nazha', 'name_ar' => 'حي النزهة'],
            ['city_id' => 11, 'name_en' => 'Al-Zahra', 'name_ar' => 'حي الزهراء'],
            ['city_id' => 11, 'name_en' => 'Al-Rawda', 'name_ar' => 'حي الروضة'],
            ['city_id' => 11, 'name_en' => 'Al-Safa', 'name_ar' => 'حي الصفا'],
            ['city_id' => 11, 'name_en' => 'Al-Raihan', 'name_ar' => 'حي الريحان'],
            ['city_id' => 11, 'name_en' => 'Al-Murooj', 'name_ar' => 'حي المروج'],
            ['city_id' => 11, 'name_en' => 'Al-Ayoun', 'name_ar' => 'حي العيون'],
            ['city_id' => 11, 'name_en' => 'Al-Jabart', 'name_ar' => 'حي الجبارات'],
            ['city_id' => 11, 'name_en' => 'Prince Hamza', 'name_ar' => 'حي الأمير حمزة'],
            ['city_id' => 11, 'name_en' => 'Al-Mansheya', 'name_ar' => 'حي المنشية'],
            ['city_id' => 11, 'name_en' => 'Ajloun', 'name_ar' => 'عجلون (مركز اللواء)'],
            ['city_id' => 11, 'name_en' => 'Anjarah', 'name_ar' => 'عنجرة'],
            ['city_id' => 11, 'name_en' => 'Ain Jana', 'name_ar' => 'عين جنا'],
            ['city_id' => 11, 'name_en' => 'Al-Hashmiya', 'name_ar' => 'الهاشمية'],
            ['city_id' => 11, 'name_en' => 'Al-Wahadna', 'name_ar' => 'الوهادنة'],
            ['city_id' => 11, 'name_en' => 'Halawa', 'name_ar' => 'حلاوة'],
            ['city_id' => 11, 'name_en' => 'Deir As-Samadiyah Al-Shamali', 'name_ar' => 'دير الصمادية الشمالي'],
            ['city_id' => 11, 'name_en' => 'Khashiba Al-Fouqa', 'name_ar' => 'خشيبة الفوقا'],
            ['city_id' => 11, 'name_en' => 'Jabal Al-Akhdar', 'name_ar' => 'الجبل الأخضر'],
            ['city_id' => 11, 'name_en' => 'Al-Shakara', 'name_ar' => 'الشكارة'],
            ['city_id' => 11, 'name_en' => 'Al-Fakhira', 'name_ar' => 'الفاخرة'],
            ['city_id' => 11, 'name_en' => 'Mahna', 'name_ar' => 'محنا'],
            ['city_id' => 11, 'name_en' => 'Ishtafina', 'name_ar' => 'إشتفينا'],
            ['city_id' => 11, 'name_en' => 'Al-Tayyara', 'name_ar' => 'الطيارة'],
            ['city_id' => 11, 'name_en' => 'Umm Al-Yanabea', 'name_ar' => 'أم الينابيع'],
            ['city_id' => 11, 'name_en' => 'Al-Sakhna', 'name_ar' => 'الساخنة'],
            ['city_id' => 11, 'name_en' => 'Al-Hansh', 'name_ar' => 'الحنش'],
            ['city_id' => 11, 'name_en' => 'Khurbet Al-Souq', 'name_ar' => 'خربة السوق'],
            ['city_id' => 11, 'name_en' => 'Al-Zira’a', 'name_ar' => 'الزراعة'],
            ['city_id' => 11, 'name_en' => 'Kafr Al-Durra', 'name_ar' => 'كفر الدرة'],
            ['city_id' => 11, 'name_en' => 'Al-Jab', 'name_ar' => 'الجب'],
            ['city_id' => 11, 'name_en' => 'Al-Hazar', 'name_ar' => 'الحزار'],
            ['city_id' => 11, 'name_en' => 'Al-Zizafuna', 'name_ar' => 'الزيزفونة'],
            ['city_id' => 11, 'name_en' => 'Al-Sarabes', 'name_ar' => 'السرابيس'],
            ['city_id' => 11, 'name_en' => 'Umm Al-Khashab', 'name_ar' => 'أم الخشب'],
            ['city_id' => 11, 'name_en' => 'Khilat Salem', 'name_ar' => 'خلة سالم'],
            ['city_id' => 11, 'name_en' => 'Khilat Warda', 'name_ar' => 'خلة وردة'],
            ['city_id' => 11, 'name_en' => 'Al-Naqab', 'name_ar' => 'النقب'],
            ['city_id' => 11, 'name_en' => 'Owaymir', 'name_ar' => 'عويمر'],
            ['city_id' => 11, 'name_en' => 'Al-Zaatra', 'name_ar' => 'الزعترة'],
            ['city_id' => 11, 'name_en' => 'Rajeb', 'name_ar' => 'راجب'],
            ['city_id' => 11, 'name_en' => 'Rass Munif', 'name_ar' => 'رأس منيف'],
            ['city_id' => 11, 'name_en' => 'Balas', 'name_ar' => 'بلاص'],
            ['city_id' => 11, 'name_en' => 'Awsara', 'name_ar' => 'أوصرة'],
            ['city_id' => 11, 'name_en' => 'Lustab', 'name_ar' => 'لستب'],
            ['city_id' => 11, 'name_en' => 'Oseim', 'name_ar' => 'عصيم'],
            ['city_id' => 11, 'name_en' => 'Sakrah', 'name_ar' => 'صخرة'],
            ['city_id' => 11, 'name_en' => 'Abyin', 'name_ar' => 'عبين'],
            ['city_id' => 11, 'name_en' => 'Ablin', 'name_ar' => 'عبلين'],
            ['city_id' => 11, 'name_en' => 'Samta', 'name_ar' => 'سامتا'],
            ['city_id' => 11, 'name_en' => 'Arjan', 'name_ar' => 'عرجان'],
            ['city_id' => 11, 'name_en' => 'Baoun', 'name_ar' => 'باعون'],
            ['city_id' => 11, 'name_en' => 'Kaddadah', 'name_ar' => 'كداده'],
            ['city_id' => 11, 'name_en' => 'Kfarnja', 'name_ar' => 'كفرنجة (مركز اللواء)'],
            ['city_id' => 11, 'name_en' => 'Rason', 'name_ar' => 'راسون'],
            ['city_id' => 11, 'name_en' => 'Kfarabel', 'name_ar' => 'كفرابيل'],
            ['city_id' => 11, 'name_en' => 'Afna', 'name_ar' => 'عفنا'],
            ['city_id' => 11, 'name_en' => 'Maqbala', 'name_ar' => 'مقبلة'],
            ['city_id' => 11, 'name_en' => 'Umm Al-Amad', 'name_ar' => 'أم العمد'],
            ['city_id' => 11, 'name_en' => 'Khurbet Al-Manara', 'name_ar' => 'خربة المنارة'],
            ['city_id' => 11, 'name_en' => 'Khurbet Sheikh Mohammad', 'name_ar' => 'خربة الشيخ محمد'],
            ['city_id' => 11, 'name_en' => 'Khurbet Al-Ain', 'name_ar' => 'خربة العين'],
            ['city_id' => 11, 'name_en' => 'Khurbet Al-Zaytoun', 'name_ar' => 'خربة الزيتون'],
            ['city_id' => 11, 'name_en' => 'Khurbet Al-Nakhl', 'name_ar' => 'خربة النخل'],
            // معان
            ['city_id' => 12, 'name_en' => 'Central City', 'name_ar' => 'وسط المدينة'],
            ['city_id' => 12, 'name_en' => 'Abu Bakr Al-Siddiq', 'name_ar' => 'حي أبو بكر الصديق'],
            ['city_id' => 12, 'name_en' => 'Khir Al-Din Al-Ma\'ani', 'name_ar' => 'حي خير الدين المعاني'],
            ['city_id' => 12, 'name_en' => 'Al-Shamiya', 'name_ar' => 'حي الشامية'],
            ['city_id' => 12, 'name_en' => 'Khalil Abu Odah', 'name_ar' => 'حي خليل أبو عودة'],
            ['city_id' => 12, 'name_en' => 'Al-Nuzha', 'name_ar' => 'حي النزهة'],
            ['city_id' => 12, 'name_en' => 'Al-Zahra', 'name_ar' => 'حي الزهراء'],
            ['city_id' => 12, 'name_en' => 'Al-Safa', 'name_ar' => 'حي الصفا'],
            ['city_id' => 12, 'name_en' => 'Al-Rayhan', 'name_ar' => 'حي الريحان'],
            ['city_id' => 12, 'name_en' => 'Al-Murooj', 'name_ar' => 'حي المروج'],
            ['city_id' => 12, 'name_en' => 'Al-Ayoun', 'name_ar' => 'حي العيون'],
            ['city_id' => 12, 'name_en' => 'Al-Manshiyah', 'name_ar' => 'حي المنشية'],
            ['city_id' => 12, 'name_en' => 'Ma\'an (Central Region)', 'name_ar' => 'معان (مركز اللواء)'],
            ['city_id' => 12, 'name_en' => 'Sath Ma\'an', 'name_ar' => 'سطح معان'],
            ['city_id' => 12, 'name_en' => 'Al-Baleel', 'name_ar' => 'البليل'],
            ['city_id' => 12, 'name_en' => 'Al-Zaghba', 'name_ar' => 'الزغبة'],
            ['city_id' => 12, 'name_en' => 'Al-Talaysa', 'name_ar' => 'الطليسية'],
            ['city_id' => 12, 'name_en' => 'Al-Fan Al-Wasatani', 'name_ar' => 'الفان الوسطاني'],
            ['city_id' => 12, 'name_en' => 'Al-Fan Al-Qabali', 'name_ar' => 'الفان القبلي'],
            ['city_id' => 12, 'name_en' => 'Abu Mansaf', 'name_ar' => 'أبو منسف'],
            ['city_id' => 12, 'name_en' => 'Al-Mubtan', 'name_ar' => 'المبطن'],
            ['city_id' => 12, 'name_en' => 'Miryud', 'name_ar' => 'مريود'],
            ['city_id' => 12, 'name_en' => 'Al-Tuba', 'name_ar' => 'الطوبا'],
            ['city_id' => 12, 'name_en' => 'Nawa', 'name_ar' => 'نوى'],
            ['city_id' => 12, 'name_en' => 'Halban', 'name_ar' => 'حلبان'],
            ['city_id' => 12, 'name_en' => 'Al-Thawra', 'name_ar' => 'الثورة'],
            ['city_id' => 12, 'name_en' => 'Sheikh Ali Kason', 'name_ar' => 'الشيخ علي كاسون'],
            ['city_id' => 12, 'name_en' => 'Tel Dhab', 'name_ar' => 'تل دهب'],
            ['city_id' => 12, 'name_en' => 'Saba', 'name_ar' => 'سباع'],
            ['city_id' => 12, 'name_en' => 'Al-Buayda', 'name_ar' => 'البويضة'],
            ['city_id' => 12, 'name_en' => 'Al-Ruwayf', 'name_ar' => 'الرويف'],
            ['city_id' => 12, 'name_en' => 'Al-Sheha', 'name_ar' => 'الشيحة'],
            ['city_id' => 12, 'name_en' => 'Adhrah', 'name_ar' => 'أذرح'],
            ['city_id' => 12, 'name_en' => 'Al-Ashari', 'name_ar' => 'الأشعري'],
            ['city_id' => 12, 'name_en' => 'Al-Jurba Al-Saghira', 'name_ar' => 'الجرباء الصغيرة'],
            ['city_id' => 12, 'name_en' => 'Al-Jurba Al-Kabira', 'name_ar' => 'الجرباء الكبيرة'],
            ['city_id' => 12, 'name_en' => 'Al-Mohamadia', 'name_ar' => 'المحمدية'],
            ['city_id' => 12, 'name_en' => 'Al-Tamya', 'name_ar' => 'الطميعة'],
            ['city_id' => 12, 'name_en' => 'Najda', 'name_ar' => 'نجدة'],
            ['city_id' => 12, 'name_en' => 'Al-Maqam', 'name_ar' => 'المقام'],
            ['city_id' => 12, 'name_en' => 'Al-Arqoub', 'name_ar' => 'العرقوب'],
            ['city_id' => 12, 'name_en' => 'Al-Dabba', 'name_ar' => 'الدبة'],
            ['city_id' => 12, 'name_en' => 'Al-Kharba', 'name_ar' => 'الخربة'],
            ['city_id' => 12, 'name_en' => 'Al-Sayl', 'name_ar' => 'السيل'],
            ['city_id' => 12, 'name_en' => 'Al-Ain Al-Bayda', 'name_ar' => 'العين البيضاء'],
            ['city_id' => 12, 'name_en' => 'Al-Rashidiya', 'name_ar' => 'الراشدية'],
            ['city_id' => 12, 'name_en' => 'Al-Muraygha', 'name_ar' => 'المريغة'],
            ['city_id' => 12, 'name_en' => 'Al-Qatrana', 'name_ar' => 'القطرانة'],
            ['city_id' => 12, 'name_en' => 'Al-Najada', 'name_ar' => 'النجادة'],
            ['city_id' => 12, 'name_en' => 'Al-Hamima', 'name_ar' => 'الحميمة'],
            ['city_id' => 12, 'name_en' => 'Al-Aqila', 'name_ar' => 'العقيلة'],
            ['city_id' => 12, 'name_en' => 'Al-Madoura', 'name_ar' => 'المدورة'],
            ['city_id' => 12, 'name_en' => 'Ayniza', 'name_ar' => 'عنيزة'],
            ['city_id' => 12, 'name_en' => 'Al-Disa', 'name_ar' => 'الديسة'],
            ['city_id' => 12, 'name_en' => 'Al-Qweira', 'name_ar' => 'القويرة'],
            ['city_id' => 12, 'name_en' => 'Al-Manshiyah', 'name_ar' => 'المنشية'],
            ['city_id' => 12, 'name_en' => 'Al-Rahma', 'name_ar' => 'الرحمة'],
            ['city_id' => 12, 'name_en' => 'Al-Maamara', 'name_ar' => 'المعامرة'],
            ['city_id' => 12, 'name_en' => 'Al-Jafr', 'name_ar' => 'الجفر'],
            ['city_id' => 12, 'name_en' => 'Al-Marzouq', 'name_ar' => 'المرزوق'],
            ['city_id' => 12, 'name_en' => 'Al-Samha', 'name_ar' => 'السمحة'],
            ['city_id' => 12, 'name_en' => 'Al-Salmany', 'name_ar' => 'السلماني'],
            ['city_id' => 12, 'name_en' => 'Al-Dhahiriya', 'name_ar' => 'الظاهرية'],
            ['city_id' => 12, 'name_en' => 'Khurbet Al-Nakhil', 'name_ar' => 'خربة النخيل'],
            ['city_id' => 12, 'name_en' => 'Khurbet Al-Zaytoun', 'name_ar' => 'خربة الزيتون'],
            ['city_id' => 12, 'name_en' => 'Wadi Musa (Central Region)', 'name_ar' => 'وادي موسى (مركز اللواء)'],
            ['city_id' => 12, 'name_en' => 'Petra', 'name_ar' => 'البتراء'],
            ['city_id' => 12, 'name_en' => 'Um Sihoon', 'name_ar' => 'أم سيحون'],
            ['city_id' => 12, 'name_en' => 'Bayda', 'name_ar' => 'بيضاء'],
            ['city_id' => 12, 'name_en' => 'Taybah', 'name_ar' => 'الطيبة'],
            ['city_id' => 12, 'name_en' => 'Rajf', 'name_ar' => 'راجف'],
            ['city_id' => 12, 'name_en' => 'Dilaaga', 'name_ar' => 'ديلاغة'],
            ['city_id' => 12, 'name_en' => 'Kherbat Nabi Harun', 'name_ar' => 'خربة النبي هارون'],
            ['city_id' => 12, 'name_en' => 'Shoubak (Central Region)', 'name_ar' => 'الشوبك (مركز اللواء)'],
            ['city_id' => 12, 'name_en' => 'Bir Seba', 'name_ar' => 'بئر السبع'],
            ['city_id' => 12, 'name_en' => 'Al-Qadisiyah', 'name_ar' => 'القادسية'],
            ['city_id' => 12, 'name_en' => 'Al-Mughayer', 'name_ar' => 'المغير'],
            ['city_id' => 12, 'name_en' => 'Kherbat Sheikh Issa', 'name_ar' => 'خربة الشيخ عيسى'],
            ['city_id' => 12, 'name_en' => 'Kherbat Al-Mudawara', 'name_ar' => 'خربة المدورة'],
            ['city_id' => 12, 'name_en' => 'Husseiniyah (Central Region)', 'name_ar' => 'الحسينية (مركز اللواء)'],
            ['city_id' => 12, 'name_en' => 'Ai', 'name_ar' => 'عي'],
            ['city_id' => 12, 'name_en' => 'Jouza', 'name_ar' => 'جوزا'],
            ['city_id' => 12, 'name_en' => 'Kathirba', 'name_ar' => 'كثربا'],
            ['city_id' => 12, 'name_en' => 'Ramaadna', 'name_ar' => 'الرماضنة'],
            ['city_id' => 12, 'name_en' => 'Al-Qurala', 'name_ar' => 'القرالة'],
            ['city_id' => 12, 'name_en' => 'Al-Jawaznah', 'name_ar' => 'الجوازنة'],
            //
            // القاهرة (city_id: 13)
            // رئيسية
            ['city_id' => 13, 'name_en' => 'Zamalek', 'name_ar' => 'الزمالك'],
            ['city_id' => 13, 'name_en' => 'Maadi', 'name_ar' => 'المعادي'],
            ['city_id' => 13, 'name_en' => 'Nasr City', 'name_ar' => 'مدينة نصر'],
            ['city_id' => 13, 'name_en' => 'Heliopolis', 'name_ar' => 'مصر الجديدة'],
            ['city_id' => 13, 'name_en' => 'Downtown Cairo', 'name_ar' => 'وسط البلد'],
            ['city_id' => 13, 'name_en' => 'Fifth Settlement', 'name_ar' => 'التجمع الخامس'],
            // فرعية
            ['city_id' => 13, 'name_en' => 'Sayeda Zeinab', 'name_ar' => 'السيدة زينب'],
            ['city_id' => 13, 'name_en' => 'Corniche El Maadi', 'name_ar' => 'كورنيش المعادي'],
            ['city_id' => 13, 'name_en' => 'Nozha', 'name_ar' => 'النزهة'],
            ['city_id' => 13, 'name_en' => 'Shorouk City', 'name_ar' => 'مدينة الشروق'],

            // الإسكندرية (city_id: 14)
            // رئيسية
            ['city_id' => 14, 'name_en' => 'Montaza', 'name_ar' => 'المنتزه'],
            ['city_id' => 14, 'name_en' => 'Smouha', 'name_ar' => 'سموحة'],
            ['city_id' => 14, 'name_en' => 'Sidi Gaber', 'name_ar' => 'سيدي جابر'],
            ['city_id' => 14, 'name_en' => 'Roushdy', 'name_ar' => 'رشدي'],
            ['city_id' => 14, 'name_en' => 'Agami', 'name_ar' => 'العجمي'],
            ['city_id' => 14, 'name_en' => 'Downtown Alexandria', 'name_ar' => 'وسط البلد'],
            // فرعية
            ['city_id' => 14, 'name_en' => 'Sidi Bishr', 'name_ar' => 'سيدي بشر'],
            ['city_id' => 14, 'name_en' => 'Miami', 'name_ar' => 'ميامي'],
            ['city_id' => 14, 'name_en' => 'Sugar District', 'name_ar' => 'حي السكر'],
            ['city_id' => 14, 'name_en' => 'Kafr Abdou', 'name_ar' => 'كفر عبده'],

            // الجيزة (city_id: 15)
            // رئيسية
            ['city_id' => 15, 'name_en' => 'Dokki', 'name_ar' => 'الدقي'],
            ['city_id' => 15, 'name_en' => 'Mohandessin', 'name_ar' => 'المهندسين'],
            ['city_id' => 15, 'name_en' => 'Imbaba', 'name_ar' => 'إمبابة'],
            ['city_id' => 15, 'name_en' => '6th of October', 'name_ar' => '6 أكتوبر'],
            ['city_id' => 15, 'name_en' => 'Sheikh Zayed', 'name_ar' => 'الشيخ زايد'],
            ['city_id' => 15, 'name_en' => 'Hadayek Al Ahram', 'name_ar' => 'حدائق الأهرام'],
            // فرعية
            ['city_id' => 15, 'name_en' => 'Warraq Island', 'name_ar' => 'جزيرة الوراق'],
            ['city_id' => 15, 'name_en' => 'Haram', 'name_ar' => 'الهرم'],
            ['city_id' => 15, 'name_en' => 'Faisal', 'name_ar' => 'فيصل'],
            ['city_id' => 15, 'name_en' => 'Badr City', 'name_ar' => 'مدينة بدر'],

            // بورسعيد (city_id: 16)
            // رئيسية
            ['city_id' => 16, 'name_en' => 'Sharq', 'name_ar' => 'الشرق'],
            ['city_id' => 16, 'name_en' => 'Manakh', 'name_ar' => 'المناخ'],
            ['city_id' => 16, 'name_en' => 'Arab', 'name_ar' => 'العرب'],
            ['city_id' => 16, 'name_en' => 'Dawahy', 'name_ar' => 'الضواحي'],
            ['city_id' => 16, 'name_en' => 'New Port Said', 'name_ar' => 'بورسعيد الجديدة'],
            // فرعية
            ['city_id' => 16, 'name_en' => 'Zohour', 'name_ar' => 'الزهور'],
            ['city_id' => 16, 'name_en' => 'Port Fouad', 'name_ar' => 'بورتوفيق'],

            // السويس (city_id: 17)
            // رئيسية
            ['city_id' => 17, 'name_en' => 'Suez District', 'name_ar' => 'السويس'],
            ['city_id' => 17, 'name_en' => 'Arbaeen', 'name_ar' => 'الأربعين'],
            ['city_id' => 17, 'name_en' => 'Faisal', 'name_ar' => 'فيصل'],
            ['city_id' => 17, 'name_en' => 'Ganayen', 'name_ar' => 'الجناين'],
            // فرعية
            ['city_id' => 17, 'name_en' => 'Attaka', 'name_ar' => 'العطاقة'],
            ['city_id' => 17, 'name_en' => 'Mubarak District', 'name_ar' => 'حي مبارك'],

            // الأقصر (city_id: 18)
            // رئيسية
            ['city_id' => 18, 'name_en' => 'Karnak', 'name_ar' => 'الكرنك'],
            ['city_id' => 18, 'name_en' => 'East Bank', 'name_ar' => 'شرق النيل'],
            ['city_id' => 18, 'name_en' => 'West Bank', 'name_ar' => 'غرب النيل'],
            ['city_id' => 18, 'name_en' => 'Awamiya', 'name_ar' => 'العوامية'],
            // فرعية
            ['city_id' => 18, 'name_en' => 'Bayadiya', 'name_ar' => 'البياضية'],
            ['city_id' => 18, 'name_en' => 'Qurna', 'name_ar' => 'القرنة'],

            // أسوان (city_id: 19)
            // رئيسية
            ['city_id' => 19, 'name_en' => 'Downtown Aswan', 'name_ar' => 'وسط أسوان'],
            ['city_id' => 19, 'name_en' => 'Elephantine Island', 'name_ar' => 'جزيرة الفنتين'],
            ['city_id' => 19, 'name_en' => 'Gharb Sohail', 'name_ar' => 'غرب سهيل'],
            ['city_id' => 19, 'name_en' => 'Kom Ombo', 'name_ar' => 'كوم أمبو'],
            // فرعية
            ['city_id' => 19, 'name_en' => 'Nasser City', 'name_ar' => 'مدينة ناصر'],
            ['city_id' => 19, 'name_en' => 'Abu El Rish', 'name_ar' => 'أبو الريش'],

            // الإسماعيلية (city_id: 20)
            // رئيسية
            ['city_id' => 20, 'name_en' => 'Downtown Ismailia', 'name_ar' => 'وسط الإسماعيلية'],
            ['city_id' => 20, 'name_en' => 'Sheikh Zayed District', 'name_ar' => 'حي الشيخ زايد'],
            ['city_id' => 20, 'name_en' => 'Fayrouz District', 'name_ar' => 'حي الفيروز'],
            ['city_id' => 20, 'name_en' => 'Qantara Sharq', 'name_ar' => 'القنطرة شرق'],
            // فرعية
            ['city_id' => 20, 'name_en' => 'Fayed', 'name_ar' => 'فايد'],
            ['city_id' => 20, 'name_en' => 'Abu Suwir', 'name_ar' => 'أبو صوير'],

            // دمياط (city_id: 21)
            // رئيسية
            ['city_id' => 21, 'name_en' => 'Downtown Damietta', 'name_ar' => 'وسط دمياط'],
            ['city_id' => 21, 'name_en' => 'Ras El Bar', 'name_ar' => 'رأس البر'],
            ['city_id' => 21, 'name_en' => 'New Damietta', 'name_ar' => 'دمياط الجديدة'],
            ['city_id' => 21, 'name_en' => 'Kafr Saad', 'name_ar' => 'كفر سعد'],
            // فرعية
            ['city_id' => 21, 'name_en' => 'Faraskur', 'name_ar' => 'فارسكور'],
            ['city_id' => 21, 'name_en' => 'Zarqa', 'name_ar' => 'الزرقا'],

            // المنصورة (city_id: 22)
            // رئيسية
            ['city_id' => 22, 'name_en' => 'Downtown Mansoura', 'name_ar' => 'وسط المنصورة'],
            ['city_id' => 22, 'name_en' => 'Gomrok', 'name_ar' => 'الجمرك'],
            ['city_id' => 22, 'name_en' => 'Mit Khamis', 'name_ar' => 'ميت خميس'],
            ['city_id' => 22, 'name_en' => 'Talkha', 'name_ar' => 'طلخا'],
            // فرعية
            ['city_id' => 22, 'name_en' => 'Belqas', 'name_ar' => 'بلقاس'],
            ['city_id' => 22, 'name_en' => 'Sherbin', 'name_ar' => 'شربين'],

            // الزقازيق (city_id: 23)
            // رئيسية
            ['city_id' => 23, 'name_en' => 'Downtown Zagazig', 'name_ar' => 'وسط الزقازيق'],
            ['city_id' => 23, 'name_en' => 'Al Ahrar District', 'name_ar' => 'حي الأحرار'],
            ['city_id' => 23, 'name_en' => 'Zohour District', 'name_ar' => 'حي الزهور'],
            ['city_id' => 23, 'name_en' => 'Minya Al Qamh', 'name_ar' => 'منيا القمح'],
            // فرعية
            ['city_id' => 23, 'name_en' => 'Abu Hammad', 'name_ar' => 'أبو حماد'],
            ['city_id' => 23, 'name_en' => 'Diyarb Negm', 'name_ar' => 'ديرب نجم'],

            // طنطا (city_id: 24)
            // رئيسية
            ['city_id' => 24, 'name_en' => 'Downtown Tanta', 'name_ar' => 'وسط طنطا'],
            ['city_id' => 24, 'name_en' => 'Seiger', 'name_ar' => 'سيجر'],
            ['city_id' => 24, 'name_en' => 'Mahatta', 'name_ar' => 'المحطة'],
            ['city_id' => 24, 'name_en' => 'Moatasem', 'name_ar' => 'المعتصم'],
            // فرعية
            ['city_id' => 24, 'name_en' => 'Qutour', 'name_ar' => 'قطور'],
            ['city_id' => 24, 'name_en' => 'Zefta', 'name_ar' => 'زفتى'],

            // الفيوم (city_id: 25)
            // رئيسية
            ['city_id' => 25, 'name_en' => 'Downtown Faiyum', 'name_ar' => 'وسط الفيوم'],
            ['city_id' => 25, 'name_en' => 'Sinnuris', 'name_ar' => 'سنورس'],
            ['city_id' => 25, 'name_en' => 'Tamiya', 'name_ar' => 'طامية'],
            ['city_id' => 25, 'name_en' => 'Itsa', 'name_ar' => 'إطسا'],
            // فرعية
            ['city_id' => 25, 'name_en' => 'Yusuf Al Siddiq', 'name_ar' => 'يوسف الصديق'],
            ['city_id' => 25, 'name_en' => 'Ibshaway', 'name_ar' => 'إبشواي'],

            // بنها (city_id: 26)
            // رئيسية
            ['city_id' => 26, 'name_en' => 'Downtown Banha', 'name_ar' => 'وسط بنها'],
            ['city_id' => 26, 'name_en' => 'Kafr Al Gazzar', 'name_ar' => 'كفر الجزار'],
            ['city_id' => 26, 'name_en' => 'Zohour District', 'name_ar' => 'حي الزهور'],
            ['city_id' => 26, 'name_en' => 'Shubra Al Kheima', 'name_ar' => 'شبرا الخيمة'],
            // فرعية
            ['city_id' => 26, 'name_en' => 'Qalyub', 'name_ar' => 'قليوب'],
            ['city_id' => 26, 'name_en' => 'Toukh', 'name_ar' => 'طوخ'],

            // المنيا (city_id: 27)
            // رئيسية
            ['city_id' => 27, 'name_en' => 'Downtown Minya', 'name_ar' => 'وسط المنيا'],
            ['city_id' => 27, 'name_en' => 'Mallawi', 'name_ar' => 'ملوي'],
            ['city_id' => 27, 'name_en' => 'Samalut', 'name_ar' => 'سمالوط'],
            ['city_id' => 27, 'name_en' => 'Beni Mazar', 'name_ar' => 'بني مزار'],
            // فرعية
            ['city_id' => 27, 'name_en' => 'Maghagha', 'name_ar' => 'مغاغة'],
            ['city_id' => 27, 'name_en' => 'Sheikh Abada', 'name_ar' => 'الشيخ عبادة'],

            // أسيوط (city_id: 28)
            // رئيسية
            ['city_id' => 28, 'name_en' => 'Downtown Assiut', 'name_ar' => 'وسط أسيوط'],
            ['city_id' => 28, 'name_en' => 'Al Fath', 'name_ar' => 'الفتح'],
            ['city_id' => 28, 'name_en' => 'Manfalut', 'name_ar' => 'منفلوط'],
            ['city_id' => 28, 'name_en' => 'Dayrout', 'name_ar' => 'ديروط'],
            // فرعية
            ['city_id' => 28, 'name_en' => 'Abnub', 'name_ar' => 'أبنوب'],
            ['city_id' => 28, 'name_en' => 'Sahel Selim', 'name_ar' => 'ساحل سليم'],

            // سوهاج (city_id: 29)
            // رئيسية
            ['city_id' => 29, 'name_en' => 'Downtown Sohag', 'name_ar' => 'وسط سوهاج'],
            ['city_id' => 29, 'name_en' => 'Girga', 'name_ar' => 'جرجا'],
            ['city_id' => 29, 'name_en' => 'Tahta', 'name_ar' => 'طهطا'],
            ['city_id' => 29, 'name_en' => 'Akhmim', 'name_ar' => 'أخميم'],
            // فرعية
            ['city_id' => 29, 'name_en' => 'Maragha', 'name_ar' => 'المراغة'],
            ['city_id' => 29, 'name_en' => 'Juhayna', 'name_ar' => 'جهينة'],

            // قنا (city_id: 30)
            // رئيسية
            ['city_id' => 30, 'name_en' => 'Downtown Qena', 'name_ar' => 'وسط قنا'],
            ['city_id' => 30, 'name_en' => 'Nag Hammadi', 'name_ar' => 'نجع حمادي'],
            ['city_id' => 30, 'name_en' => 'Qus', 'name_ar' => 'قوص'],
            ['city_id' => 30, 'name_en' => 'Naqada', 'name_ar' => 'نقادة'],
            // فرعية
            ['city_id' => 30, 'name_en' => 'Farshut', 'name_ar' => 'فرشوط'],
            ['city_id' => 30, 'name_en' => 'Dishna', 'name_ar' => 'دشنا'],

            // كفر الشيخ (city_id: 31)
            // رئيسية
            ['city_id' => 31, 'name_en' => 'Downtown Kafr El Sheikh', 'name_ar' => 'وسط كفر الشيخ'],
            ['city_id' => 31, 'name_en' => 'Desouk', 'name_ar' => 'دسوق'],
            ['city_id' => 31, 'name_en' => 'Fuwwah', 'name_ar' => 'فوه'],
            ['city_id' => 31, 'name_en' => 'Mutubas', 'name_ar' => 'مطوبس'],
            // فرعية
            ['city_id' => 31, 'name_en' => 'Baltim', 'name_ar' => 'بلطيم'],
            ['city_id' => 31, 'name_en' => 'Sidi Salem', 'name_ar' => 'سيدي سالم'],

            // بني سويف (city_id: 32)
            // رئيسية
            ['city_id' => 32, 'name_en' => 'Downtown Beni Suef', 'name_ar' => 'وسط بني سويف'],
            ['city_id' => 32, 'name_en' => 'Al Wasta', 'name_ar' => 'الواسطى'],
            ['city_id' => 32, 'name_en' => 'Nasser', 'name_ar' => 'ناصر'],
            ['city_id' => 32, 'name_en' => 'Beba', 'name_ar' => 'ببا'],
            // فرعية
            ['city_id' => 32, 'name_en' => 'Ihnasya', 'name_ar' => 'إهناسيا'],
            ['city_id' => 32, 'name_en' => 'Fashn', 'name_ar' => 'فشن'],

            // دمنهور (city_id: 33)
            // رئيسية
            ['city_id' => 33, 'name_en' => 'Downtown Damanhur', 'name_ar' => 'وسط دمنهور'],
            ['city_id' => 33, 'name_en' => 'Kafr El Dawar', 'name_ar' => 'كفر الدوار'],
            ['city_id' => 33, 'name_en' => 'Itai El Barud', 'name_ar' => 'إيتاي البارود'],
            ['city_id' => 33, 'name_en' => 'Abu Hummus', 'name_ar' => 'أبو حمص'],
            // فرعية
            ['city_id' => 33, 'name_en' => 'Hosh Issa', 'name_ar' => 'حوش عيسى'],
            ['city_id' => 33, 'name_en' => 'Shubrakhit', 'name_ar' => 'شبراخيت'],

            // شبين الكوم (city_id: 34)
            // رئيسية
            ['city_id' => 34, 'name_en' => 'Downtown Shibin El Kom', 'name_ar' => 'وسط شبين الكوم'],
            ['city_id' => 34, 'name_en' => 'Tala', 'name_ar' => 'تلا'],
            ['city_id' => 34, 'name_en' => 'Quesna', 'name_ar' => 'قويسنا'],
            ['city_id' => 34, 'name_en' => 'Birket El Sab', 'name_ar' => 'بركة السبع'],
            // فرعية
            ['city_id' => 34, 'name_en' => 'Ashmun', 'name_ar' => 'أشمون'],
            ['city_id' => 34, 'name_en' => 'Sadat City', 'name_ar' => 'مدينة السادات'],

            // مرسى مطروح (city_id: 35)
            // رئيسية
            ['city_id' => 35, 'name_en' => 'Downtown Marsa Matruh', 'name_ar' => 'وسط مرسى مطروح'],
            ['city_id' => 35, 'name_en' => 'Al Alamein', 'name_ar' => 'العلمين'],
            ['city_id' => 35, 'name_en' => 'Dabaa', 'name_ar' => 'الضبعة'],
            ['city_id' => 35, 'name_en' => 'Siwa', 'name_ar' => 'سيوة'],
            // فرعية
            ['city_id' => 35, 'name_en' => 'Sallum', 'name_ar' => 'سلوم'],
            ['city_id' => 35, 'name_en' => 'Marina', 'name_ar' => 'مارينا'],

            // العريش (city_id: 36)
            // رئيسية
            ['city_id' => 36, 'name_en' => 'Downtown Arish', 'name_ar' => 'وسط العريش'],
            ['city_id' => 36, 'name_en' => 'Sheikh Zuweid', 'name_ar' => 'الشيخ زويد'],
            ['city_id' => 36, 'name_en' => 'Rafah', 'name_ar' => 'رفح'],
            // فرعية
            ['city_id' => 36, 'name_en' => 'Bir Al Abd', 'name_ar' => 'بئر العبد'],
            ['city_id' => 36, 'name_en' => 'Hassana', 'name_ar' => 'حسنة'],

            // شرم الشيخ (city_id: 37)
            // رئيسية
            ['city_id' => 37, 'name_en' => 'Naama Bay', 'name_ar' => 'خليج نعمة'],
            ['city_id' => 37, 'name_en' => 'Ras Nasrani', 'name_ar' => 'رأس نصراني'],
            ['city_id' => 37, 'name_en' => 'Sharm El Maya', 'name_ar' => 'شرم المايا'],
            ['city_id' => 37, 'name_en' => 'Hadaba', 'name_ar' => 'الهضبة'],
            // فرعية
            ['city_id' => 37, 'name_en' => 'Nabq Bay', 'name_ar' => 'خليج نبق'],
            ['city_id' => 37, 'name_en' => 'Sharks Bay', 'name_ar' => 'خليج القرش'],

            // الغردقة (city_id: 38)
            // رئيسية
            ['city_id' => 38, 'name_en' => 'Sakkala', 'name_ar' => 'السقالة'],
            ['city_id' => 38, 'name_en' => 'Dahar', 'name_ar' => 'الدهار'],
            ['city_id' => 38, 'name_en' => 'Kawthar', 'name_ar' => 'الكوثر'],
            ['city_id' => 38, 'name_en' => 'Makadi', 'name_ar' => 'مكادي'],
            // فرعية
            ['city_id' => 38, 'name_en' => 'Sahl Hasheesh', 'name_ar' => 'سهل حشيش'],
            ['city_id' => 38, 'name_en' => 'El Gouna', 'name_ar' => 'الجونة'],

            // الخارجة (city_id: 39)
            // رئيسية
            ['city_id' => 39, 'name_en' => 'Downtown Kharga', 'name_ar' => 'وسط الخارجة'],
            ['city_id' => 39, 'name_en' => 'Dakhla', 'name_ar' => 'الداخلة'],
            ['city_id' => 39, 'name_en' => 'Paris', 'name_ar' => 'باريس'],
            // فرعية
            ['city_id' => 39, 'name_en' => 'Mut', 'name_ar' => 'موط'],
            ['city_id' => 39, 'name_en' => 'Balat', 'name_ar' => 'بلاط'],

            // المحلة الكبرى (city_id: 40)
            // رئيسية
            ['city_id' => 40, 'name_en' => 'Downtown Mahalla', 'name_ar' => 'وسط المحلة'],
            ['city_id' => 40, 'name_en' => 'Samannoud', 'name_ar' => 'سمنود'],
            ['city_id' => 40, 'name_en' => 'Zefta', 'name_ar' => 'زفتى'],
            ['city_id' => 40, 'name_en' => 'Basyoun', 'name_ar' => 'بسيون'],
            // فرعية
            ['city_id' => 40, 'name_en' => 'Mahalla Abu Ali', 'name_ar' => 'المحلة أبو علي'],
            ['city_id' => 40, 'name_en' => 'Tanta Road', 'name_ar' => 'طريق طنطا'],

            // مدينة 6 أكتوبر (city_id: 41)
            // رئيسية
            ['city_id' => 41, 'name_en' => 'Motamayez District', 'name_ar' => 'الحي المتميز'],
            ['city_id' => 41, 'name_en' => 'Ashgar District', 'name_ar' => 'حي الأشجار'],
            ['city_id' => 41, 'name_en' => 'Dream Land', 'name_ar' => 'دريم لاند'],
            ['city_id' => 41, 'name_en' => 'West Somid', 'name_ar' => 'غرب الصوميد'],
            // فرعية
            ['city_id' => 41, 'name_en' => 'South Academy', 'name_ar' => 'جنوب الأكاديمية'],
            ['city_id' => 41, 'name_en' => 'Mall of Arabia', 'name_ar' => 'مول العرب'],

            // حلوان (city_id: 42)
            // رئيسية
            ['city_id' => 42, 'name_en' => 'Downtown Helwan', 'name_ar' => 'وسط حلوان'],
            ['city_id' => 42, 'name_en' => '15 May', 'name_ar' => '15 مايو'],
            ['city_id' => 42, 'name_en' => 'Masaken', 'name_ar' => 'المساكن'],
            ['city_id' => 42, 'name_en' => 'Ezbet El Walda', 'name_ar' => 'عزبة الوالدة'],
            // فرعية
            ['city_id' => 42, 'name_en' => 'Helwan Gardens', 'name_ar' => 'حدائق حلوان'],
            ['city_id' => 42, 'name_en' => 'Maasara', 'name_ar' => 'المعصرة'],

            // رشيد (city_id: 43)
            // رئيسية
            ['city_id' => 43, 'name_en' => 'Downtown Rashid', 'name_ar' => 'وسط رشيد'],
            ['city_id' => 43, 'name_en' => 'Edku', 'name_ar' => 'إدكو'],
            ['city_id' => 43, 'name_en' => 'Mutubas', 'name_ar' => 'مطوبس'],
            // فرعية
            ['city_id' => 43, 'name_en' => 'Borg El Burullus', 'name_ar' => 'برج البرلس'],
            ['city_id' => 43, 'name_en' => 'Kom Hamada', 'name_ar' => 'كوم حمادة'],

            // كفر الدوار (city_id: 44)
            // رئيسية
            ['city_id' => 44, 'name_en' => 'Downtown Kafr El Dawar', 'name_ar' => 'وسط كفر الدوار'],
            ['city_id' => 44, 'name_en' => 'Abu Qir', 'name_ar' => 'أبو قير'],
            ['city_id' => 44, 'name_en' => 'Mandura', 'name_ar' => 'المندورة'],
            // فرعية
            ['city_id' => 44, 'name_en' => 'Kom El Naggar', 'name_ar' => 'كوم النجار'],
            ['city_id' => 44, 'name_en' => 'El Mahmoudiya', 'name_ar' => 'المحمودية'],

            // العاصمة الإدارية (city_id: 45)
            // رئيسية
            ['city_id' => 45, 'name_en' => 'Government District', 'name_ar' => 'الحي الحكومي'],
            ['city_id' => 45, 'name_en' => 'R7 Residential District', 'name_ar' => 'الحي السكني R7'],
            ['city_id' => 45, 'name_en' => 'Financial District', 'name_ar' => 'الحي المالي'],
            ['city_id' => 45, 'name_en' => 'Diplomatic District', 'name_ar' => 'الحي الدبلوماسي'],
            // فرعية
            ['city_id' => 45, 'name_en' => 'R8 Residential District', 'name_ar' => 'الحي السكني R8'],
            ['city_id' => 45, 'name_en' => 'Green River', 'name_ar' => 'النهر الأخضر'],

            // دسوق (city_id: 46)
            // رئيسية
            ['city_id' => 46, 'name_en' => 'Downtown Desouk', 'name_ar' => 'وسط دسوق'],
            ['city_id' => 46, 'name_en' => 'Kafr Magar', 'name_ar' => 'كفر مجر'],
            ['city_id' => 46, 'name_en' => 'Beila', 'name_ar' => 'بيلا'],
            // فرعية
            ['city_id' => 46, 'name_en' => 'Kafr El Sheikh Khalil', 'name_ar' => 'كفر الشيخ خليل'],
            ['city_id' => 46, 'name_en' => 'Sidi Ghazi', 'name_ar' => 'سيدي غازي'],

            // إدفو (city_id: 47)
            // رئيسية
            ['city_id' => 47, 'name_en' => 'Downtown Edfu', 'name_ar' => 'وسط إدفو'],
            ['city_id' => 47, 'name_en' => 'Kalabin', 'name_ar' => 'الكلاحين'],
            ['city_id' => 47, 'name_en' => 'Adwa', 'name_ar' => 'العدوة'],
            // فرعية
            ['city_id' => 47, 'name_en' => 'El Basaliya', 'name_ar' => 'البصيلية'],
            ['city_id' => 47, 'name_en' => 'El Hagar', 'name_ar' => 'الحجار'],

            // أبو سمبل (city_id: 48)
            // رئيسية
            ['city_id' => 48, 'name_en' => 'Downtown Abu Simbel', 'name_ar' => 'وسط أبو سمبل'],
            ['city_id' => 48, 'name_en' => 'Toshka', 'name_ar' => 'توشكى'],
            // فرعية
            ['city_id' => 48, 'name_en' => 'Qustul', 'name_ar' => 'قسطل'],

            // أسنا (city_id: 49)
            // رئيسية
            ['city_id' => 49, 'name_en' => 'Downtown Esna', 'name_ar' => 'وسط أسنا'],
            ['city_id' => 49, 'name_en' => 'Karnak', 'name_ar' => 'الكرنك'],
            ['city_id' => 49, 'name_en' => 'Keiman', 'name_ar' => 'الكيمان'],
            // فرعية
            ['city_id' => 49, 'name_en' => 'Armant', 'name_ar' => 'أرمنت'],
            ['city_id' => 49, 'name_en' => 'El Deir', 'name_ar' => 'الدير'],

            // زفتى (city_id: 50)
            // رئيسية
            ['city_id' => 50, 'name_en' => 'Downtown Zefta', 'name_ar' => 'وسط زفتى'],
            ['city_id' => 50, 'name_en' => 'Kafr Zefta', 'name_ar' => 'كفر زفتى'],
            ['city_id' => 50, 'name_en' => 'Industrial Zone', 'name_ar' => 'المنطقة الصناعية'],
            // فرعية
            ['city_id' => 50, 'name_en' => 'Mit Abu El Kom', 'name_ar' => 'ميت أبو الكوم'],
            ['city_id' => 50, 'name_en' => 'Senan', 'name_ar' => 'سنان'],

            // ميت غمر (city_id: 51)
            // رئيسية
            ['city_id' => 51, 'name_en' => 'Downtown Mit Ghamr', 'name_ar' => 'وسط ميت غمر'],
            ['city_id' => 51, 'name_en' => 'Dikirnis', 'name_ar' => 'دكرنس'],
            ['city_id' => 51, 'name_en' => 'Aga', 'name_ar' => 'أجا'],
            // فرعية
            ['city_id' => 51, 'name_en' => 'Mit Yazid', 'name_ar' => 'ميت يزيد'],
            ['city_id' => 51, 'name_en' => 'Kafr Shukr', 'name_ar' => 'كفر شكر'],

            // السنبلاوين (city_id: 52)
            // رئيسية
            ['city_id' => 52, 'name_en' => 'Downtown Senbellawein', 'name_ar' => 'وسط السنبلاوين'],
            ['city_id' => 52, 'name_en' => 'Minyat An Nasr', 'name_ar' => 'منية النصر'],
            ['city_id' => 52, 'name_en' => 'Tami Al Amdid', 'name_ar' => 'تمي الأمديد'],
            // فرعية
            ['city_id' => 52, 'name_en' => 'Manshaat El Badry', 'name_ar' => 'منشأة البدري'],
            ['city_id' => 52, 'name_en' => 'Kafr Saqr', 'name_ar' => 'كفر صقر'],

            // نجع حمادي (city_id: 53)
            // رئيسية
            ['city_id' => 53, 'name_en' => 'Downtown Nag Hammadi', 'name_ar' => 'وسط نجع حمادي'],
            ['city_id' => 53, 'name_en' => 'Dishna', 'name_ar' => 'دشنا'],
            ['city_id' => 53, 'name_en' => 'Al Waqf', 'name_ar' => 'الوقف'],
            // فرعية
            ['city_id' => 53, 'name_en' => 'Abu Tesht', 'name_ar' => 'أبو تشت'],
            ['city_id' => 53, 'name_en' => 'Hiw', 'name_ar' => 'هو'],

            // أخميم (city_id: 54)
            // رئيسية
            ['city_id' => 54, 'name_en' => 'Downtown Akhmim', 'name_ar' => 'وسط أخميم'],
            ['city_id' => 54, 'name_en' => 'Saqulta', 'name_ar' => 'ساقلته'],
            ['city_id' => 54, 'name_en' => 'Al Balina', 'name_ar' => 'البلينا'],
            // فرعية
            ['city_id' => 54, 'name_en' => 'Al Hawawish', 'name_ar' => 'الحواويش'],
            ['city_id' => 54, 'name_en' => 'Al Salamuni', 'name_ar' => 'السلاموني'],

            // طما (city_id: 55)
            // رئيسية
            ['city_id' => 55, 'name_en' => 'Downtown Tama', 'name_ar' => 'وسط طما'],
            ['city_id' => 55, 'name_en' => 'Maragha', 'name_ar' => 'المراغة'],
            ['city_id' => 55, 'name_en' => 'Juhayna', 'name_ar' => 'جهينة'],
            // فرعية
            ['city_id' => 55, 'name_en' => 'Al Koum Al Ahmar', 'name_ar' => 'الكوم الأحمر'],
            ['city_id' => 55, 'name_en' => 'Al Awqaf', 'name_ar' => 'الأوقاف'],

            // جرجا (city_id: 56)
            // رئيسية
            ['city_id' => 56, 'name_en' => 'Downtown Girga', 'name_ar' => 'وسط جرجا'],
            ['city_id' => 56, 'name_en' => 'Al Balina', 'name_ar' => 'البلينا'],
            ['city_id' => 56, 'name_en' => 'Sohag', 'name_ar' => 'سوهاج'],
            // فرعية
            ['city_id' => 56, 'name_en' => 'Bardis', 'name_ar' => 'برديس'],
            ['city_id' => 56, 'name_en' => 'Al Manshah', 'name_ar' => 'المنشأة'],

            // ديروط (city_id: 57)
            // رئيسية
            ['city_id' => 57, 'name_en' => 'Downtown Dayrout', 'name_ar' => 'وسط ديروط'],
            ['city_id' => 57, 'name_en' => 'Al Qusiya', 'name_ar' => 'القوصية'],
            ['city_id' => 57, 'name_en' => 'Manfalut', 'name_ar' => 'منفلوط'],
            // فرعية
            ['city_id' => 57, 'name_en' => 'Beni Rafi', 'name_ar' => 'بني رافع'],
            ['city_id' => 57, 'name_en' => 'Sanabu', 'name_ar' => 'صنبو'],
            // بيروت (city_id: 58)
            // رئيسية
            ['city_id' => 58, 'name_en' => 'Achrafieh', 'name_ar' => 'الأشرفية'],
            ['city_id' => 58, 'name_en' => 'Hamra', 'name_ar' => 'الحمراء'],
            ['city_id' => 58, 'name_en' => 'Downtown Beirut', 'name_ar' => 'وسط بيروت'],
            ['city_id' => 58, 'name_en' => 'Verdun', 'name_ar' => 'فردان'],
            ['city_id' => 58, 'name_en' => 'Gemmayzeh', 'name_ar' => 'الجميزة'],
            ['city_id' => 58, 'name_en' => 'Ras Beirut', 'name_ar' => 'رأس بيروت'],
            // فرعية
            ['city_id' => 58, 'name_en' => 'Ain El Mreisseh', 'name_ar' => 'عين المريسة'],
            ['city_id' => 58, 'name_en' => 'Mar Mikhael', 'name_ar' => 'مار مخايل'],
            ['city_id' => 58, 'name_en' => 'Badaro', 'name_ar' => 'بدرو'],
            ['city_id' => 58, 'name_en' => 'Raouche', 'name_ar' => 'الروشة'],

            // طرابلس (city_id: 59)
            // رئيسية
            ['city_id' => 59, 'name_en' => 'El Mina', 'name_ar' => 'الميناء'],
            ['city_id' => 59, 'name_en' => 'Bab El Tebbaneh', 'name_ar' => 'باب التبانة'],
            ['city_id' => 59, 'name_en' => 'Al Qubba', 'name_ar' => 'القبة'],
            ['city_id' => 59, 'name_en' => 'Zahrieh', 'name_ar' => 'الزاهرية'],
            ['city_id' => 59, 'name_en' => 'Downtown Tripoli', 'name_ar' => 'وسط طرابلس'],
            // فرعية
            ['city_id' => 59, 'name_en' => 'Abu Samra', 'name_ar' => 'أبو سمرا'],
            ['city_id' => 59, 'name_en' => 'Jabal Mohsen', 'name_ar' => 'جبل محسن'],
            ['city_id' => 59, 'name_en' => 'Al Tall', 'name_ar' => 'التل'],

            // صيدا (city_id: 60)
            // رئيسية
            ['city_id' => 60, 'name_en' => 'Old Saida', 'name_ar' => 'صيدا القديمة'],
            ['city_id' => 60, 'name_en' => 'Miyeh w Miyeh', 'name_ar' => 'مية ومية'],
            ['city_id' => 60, 'name_en' => 'Haret Saida', 'name_ar' => 'حارة صيدا'],
            ['city_id' => 60, 'name_en' => 'Hilaliyeh', 'name_ar' => 'الهلالية'],
            // فرعية
            ['city_id' => 60, 'name_en' => 'Abra', 'name_ar' => 'عبرا'],
            ['city_id' => 60, 'name_en' => 'Ain El Delb', 'name_ar' => 'عين الدلب'],
            ['city_id' => 60, 'name_en' => 'Bramieh', 'name_ar' => 'برامية'],

            // صور (city_id: 61)
            // رئيسية
            ['city_id' => 61, 'name_en' => 'Old Tyre', 'name_ar' => 'صور القديمة'],
            ['city_id' => 61, 'name_en' => 'Al Bass', 'name_ar' => 'البص'],
            ['city_id' => 61, 'name_en' => 'Jal El Bahr', 'name_ar' => 'جل البحر'],
            ['city_id' => 61, 'name_en' => 'Maachouk', 'name_ar' => 'معشوق'],
            // فرعية
            ['city_id' => 61, 'name_en' => 'Borj El Shemali', 'name_ar' => 'برج الشمالي'],
            ['city_id' => 61, 'name_en' => 'Rashidieh', 'name_ar' => 'الرشيدية'],

            // زحلة (city_id: 62)
            // رئيسية
            ['city_id' => 62, 'name_en' => 'Downtown Zahle', 'name_ar' => 'وسط زحلة'],
            ['city_id' => 62, 'name_en' => 'Maalaka', 'name_ar' => 'معلقة'],
            ['city_id' => 62, 'name_en' => 'Karake', 'name_ar' => 'كرك'],
            ['city_id' => 62, 'name_en' => 'Saidet Zahle', 'name_ar' => 'سيدة زحلة'],
            // فرعية
            ['city_id' => 62, 'name_en' => 'Riyak', 'name_ar' => 'رياق'],
            ['city_id' => 62, 'name_en' => 'Ksara', 'name_ar' => 'قصارة'],
            ['city_id' => 62, 'name_en' => 'Terbol', 'name_ar' => 'تربل'],

            // جبيل (city_id: 63)
            // رئيسية
            ['city_id' => 63, 'name_en' => 'Byblos Old City', 'name_ar' => 'جبيل القديمة'],
            ['city_id' => 63, 'name_en' => 'Jbeil Port', 'name_ar' => 'ميناء جبيل'],
            ['city_id' => 63, 'name_en' => 'Amchit', 'name_ar' => 'عمشيت'],
            ['city_id' => 63, 'name_en' => 'Halat', 'name_ar' => 'حالة'],
            // فرعية
            ['city_id' => 63, 'name_en' => 'Edde', 'name_ar' => 'إده'],
            ['city_id' => 63, 'name_en' => 'Blat', 'name_ar' => 'بلاط'],

            // بعبدا (city_id: 64)
            // رئيسية
            ['city_id' => 64, 'name_en' => 'Baabda', 'name_ar' => 'بعبدا'],
            ['city_id' => 64, 'name_en' => 'Hazmieh', 'name_ar' => 'الحازمية'],
            ['city_id' => 64, 'name_en' => 'Furn El Chebbak', 'name_ar' => 'فرن الشباك'],
            ['city_id' => 64, 'name_en' => 'Chiyah', 'name_ar' => 'الشياح'],
            // فرعية
            ['city_id' => 64, 'name_en' => 'Hadath', 'name_ar' => 'الحدث'],
            ['city_id' => 64, 'name_en' => 'Jamhour', 'name_ar' => 'الجمهور'],

            // جونيه (city_id: 65)
            // رئيسية
            ['city_id' => 65, 'name_en' => 'Downtown Jounieh', 'name_ar' => 'وسط جونيه'],
            ['city_id' => 65, 'name_en' => 'Kaslik', 'name_ar' => 'كسليك'],
            ['city_id' => 65, 'name_en' => 'Sarba', 'name_ar' => 'صربة'],
            ['city_id' => 65, 'name_en' => 'Ghazir', 'name_ar' => 'غزير'],
            // فرعية
            ['city_id' => 65, 'name_en' => 'Adma', 'name_ar' => 'عدما'],
            ['city_id' => 65, 'name_en' => 'Haret Sakhr', 'name_ar' => 'حارة صخر'],

            // عاليه (city_id: 66)
            // رئيسية
            ['city_id' => 66, 'name_en' => 'Downtown Aley', 'name_ar' => 'وسط عاليه'],
            ['city_id' => 66, 'name_en' => 'Bhamdoun', 'name_ar' => 'بحمدون'],
            ['city_id' => 66, 'name_en' => 'Souk El Gharb', 'name_ar' => 'سوق الغرب'],
            ['city_id' => 66, 'name_en' => 'Khalde', 'name_ar' => 'خلدة'],
            // فرعية
            ['city_id' => 66, 'name_en' => 'Ain Anoub', 'name_ar' => 'عين عنوب'],
            ['city_id' => 66, 'name_en' => 'Choueifat', 'name_ar' => 'الشويفات'],

            // بعلبك (city_id: 67)
            // رئيسية
            ['city_id' => 67, 'name_en' => 'Downtown Baalbek', 'name_ar' => 'وسط بعلبك'],
            ['city_id' => 67, 'name_en' => 'Douris', 'name_ar' => 'دوريس'],
            ['city_id' => 67, 'name_en' => 'Iaat', 'name_ar' => 'يعات'],
            ['city_id' => 67, 'name_en' => 'Ras El Ain', 'name_ar' => 'رأس العين'],
            // فرعية
            ['city_id' => 67, 'name_en' => 'Chlifa', 'name_ar' => 'شليفا'],
            ['city_id' => 67, 'name_en' => 'Temnin', 'name_ar' => 'تمنين'],

            // هرمل (city_id: 68)
            // رئيسية
            ['city_id' => 68, 'name_en' => 'Downtown Hermel', 'name_ar' => 'وسط هرمل'],
            ['city_id' => 68, 'name_en' => 'Al Qasr', 'name_ar' => 'القصر'],
            ['city_id' => 68, 'name_en' => 'Fisan', 'name_ar' => 'فيسان'],
            // فرعية
            ['city_id' => 68, 'name_en' => 'Kouakh', 'name_ar' => 'كواخ'],
            ['city_id' => 68, 'name_en' => 'Al Jamaliyeh', 'name_ar' => 'الجمالية'],

            // بنت جبيل (city_id: 69)
            // رئيسية
            ['city_id' => 69, 'name_en' => 'Downtown Bint Jbeil', 'name_ar' => 'وسط بنت جبيل'],
            ['city_id' => 69, 'name_en' => 'Ain Ebel', 'name_ar' => 'عين إبل'],
            ['city_id' => 69, 'name_en' => 'Rmeich', 'name_ar' => 'رميش'],
            // فرعية
            ['city_id' => 69, 'name_en' => 'Aitaroun', 'name_ar' => 'عيترون'],
            ['city_id' => 69, 'name_en' => 'Tibnin', 'name_ar' => 'تبنين'],
            // النبطية (city_id: 70)
            // رئيسية
            ['city_id' => 70, 'name_en' => 'Downtown Nabatieh', 'name_ar' => 'وسط النبطية'],
            ['city_id' => 70, 'name_en' => 'Kfar Roummane', 'name_ar' => 'كفر رمان'],
            ['city_id' => 70, 'name_en' => 'Zefta', 'name_ar' => 'زفتى'],
            // فرعية
            ['city_id' => 70, 'name_en' => 'Habbouch', 'name_ar' => 'حبوش'],
            ['city_id' => 70, 'name_en' => 'Jibchit', 'name_ar' => 'جبشيت'],
            // دمشق (city_id: 71)
            // رئيسية
            ['city_id' => 71, 'name_en' => 'Mezzeh', 'name_ar' => 'المزة'],
            ['city_id' => 71, 'name_en' => 'Kafar Souseh', 'name_ar' => 'كفر سوسة'],
            ['city_id' => 71, 'name_en' => 'Midan', 'name_ar' => 'الميدان'],
            ['city_id' => 71, 'name_en' => 'Baramkeh', 'name_ar' => 'برامكة'],
            ['city_id' => 71, 'name_en' => 'Old Damascus', 'name_ar' => 'دمشق القديمة'],
            ['city_id' => 71, 'name_en' => 'Malki', 'name_ar' => 'المالكي'],
            // فرعية
            ['city_id' => 71, 'name_en' => 'Bab Touma', 'name_ar' => 'باب توما'],
            ['city_id' => 71, 'name_en' => 'Qanawat', 'name_ar' => 'قنوات'],
            ['city_id' => 71, 'name_en' => 'Rukn Eddin', 'name_ar' => 'ركن الدين'],
            ['city_id' => 71, 'name_en' => 'Jobar', 'name_ar' => 'جوبر'],

            // حلب (city_id: 72)
            // رئيسية
            ['city_id' => 72, 'name_en' => 'Al Bab', 'name_ar' => 'الباب'],
            ['city_id' => 72, 'name_en' => 'Aziziyah', 'name_ar' => 'العزيزية'],
            ['city_id' => 72, 'name_en' => 'Saif Al Dawla', 'name_ar' => 'سيف الدولة'],
            ['city_id' => 72, 'name_en' => 'Old Aleppo', 'name_ar' => 'حلب القديمة'],
            ['city_id' => 72, 'name_en' => 'Jamiliyah', 'name_ar' => 'الجميلية'],
            // فرعية
            ['city_id' => 72, 'name_en' => 'Sheikh Maqsoud', 'name_ar' => 'الشيخ مقصود'],
            ['city_id' => 72, 'name_en' => 'Suleiman Al Halabi', 'name_ar' => 'سليمان الحلبي'],
            ['city_id' => 72, 'name_en' => 'Hanano', 'name_ar' => 'هنانو'],

            // حمص (city_id: 73)
            // رئيسية
            ['city_id' => 73, 'name_en' => 'Baba Amr', 'name_ar' => 'بابا عمرو'],
            ['city_id' => 73, 'name_en' => 'Al Waer', 'name_ar' => 'الوعر'],
            ['city_id' => 73, 'name_en' => 'Inshaat', 'name_ar' => 'الإنشاءات'],
            ['city_id' => 73, 'name_en' => 'Old Homs', 'name_ar' => 'حمص القديمة'],
            ['city_id' => 73, 'name_en' => 'Khalidiya', 'name_ar' => 'الخالدية'],
            // فرعية
            ['city_id' => 73, 'name_en' => 'Karm Al Zaytoun', 'name_ar' => 'كرم الزيتون'],
            ['city_id' => 73, 'name_en' => 'Al Ghouta', 'name_ar' => 'الغوطة'],

            // اللاذقية (city_id: 74)
            // رئيسية
            ['city_id' => 74, 'name_en' => 'Al Balad', 'name_ar' => 'البلد'],
            ['city_id' => 74, 'name_en' => 'Al Raml Al Janubi', 'name_ar' => 'الرمل الجنوبي'],
            ['city_id' => 74, 'name_en' => 'Al Awina', 'name_ar' => 'العوينة'],
            ['city_id' => 74, 'name_en' => 'Tishreen', 'name_ar' => 'تشرين'],
            // فرعية
            ['city_id' => 74, 'name_en' => 'Bustan Al Basha', 'name_ar' => 'بستان الباشا'],
            ['city_id' => 74, 'name_en' => 'Al Quds', 'name_ar' => 'القدس'],
            ['city_id' => 74, 'name_en' => 'Sheikh Daher', 'name_ar' => 'الشيخ ضاهر'],

            // طرطوس (city_id: 75)
            // رئيسية
            ['city_id' => 75, 'name_en' => 'Downtown Tartus', 'name_ar' => 'وسط طرطوس'],
            ['city_id' => 75, 'name_en' => 'Al Thawra', 'name_ar' => 'الثورة'],
            ['city_id' => 75, 'name_en' => 'Baniyas', 'name_ar' => 'بانياس'],
            ['city_id' => 75, 'name_en' => 'Safita', 'name_ar' => 'صافيتا'],
            // فرعية
            ['city_id' => 75, 'name_en' => 'Al Hamidiyah', 'name_ar' => 'الحميدية'],
            ['city_id' => 75, 'name_en' => 'Dreikish', 'name_ar' => 'دريكيش'],

            // دير الزور (city_id: 76)
            // رئيسية
            ['city_id' => 76, 'name_en' => 'Downtown Deir ez-Zor', 'name_ar' => 'وسط دير الزور'],
            ['city_id' => 76, 'name_en' => 'Al Jura', 'name_ar' => 'الجورة'],
            ['city_id' => 76, 'name_en' => 'Al Qusur', 'name_ar' => 'القصور'],
            ['city_id' => 76, 'name_en' => 'Al Mayadin', 'name_ar' => 'الميادين'],
            // فرعية
            ['city_id' => 76, 'name_en' => 'Al Bukamal', 'name_ar' => 'البوكمال'],
            ['city_id' => 76, 'name_en' => 'Hajin', 'name_ar' => 'هجين'],

            // الرقة (city_id: 77)
            // رئيسية
            ['city_id' => 77, 'name_en' => 'Downtown Raqqa', 'name_ar' => 'وسط الرقة'],
            ['city_id' => 77, 'name_en' => 'Al Thawra', 'name_ar' => 'الثورة'],
            ['city_id' => 77, 'name_en' => 'Al Mansur', 'name_ar' => 'المنصور'],
            ['city_id' => 77, 'name_en' => 'Tishreen', 'name_ar' => 'تشرين'],
            // فرعية
            ['city_id' => 77, 'name_en' => 'Al Daraiya', 'name_ar' => 'الدرعية'],
            ['city_id' => 77, 'name_en' => 'Al Rashad', 'name_ar' => 'الرشاد'],

            // إدلب (city_id: 78)
            // رئيسية
            ['city_id' => 78, 'name_en' => 'Downtown Idlib', 'name_ar' => 'وسط إدلب'],
            ['city_id' => 78, 'name_en' => 'Jisr Al Shughur', 'name_ar' => 'جسر الشغور'],
            ['city_id' => 78, 'name_en' => 'Maarat Al Numan', 'name_ar' => 'معرة النعمان'],
            ['city_id' => 78, 'name_en' => 'Ariha', 'name_ar' => 'أريحا'],
            // فرعية
            ['city_id' => 78, 'name_en' => 'Saraqib', 'name_ar' => 'سراقب'],
            ['city_id' => 78, 'name_en' => 'Khan Shaykhun', 'name_ar' => 'خان شيخون'],

            // درعا (city_id: 79)
            // رئيسية
            ['city_id' => 79, 'name_en' => 'Downtown Daraa', 'name_ar' => 'وسط درعا'],
            ['city_id' => 79, 'name_en' => 'Daraa Al Balad', 'name_ar' => 'درعا البلد'],
            ['city_id' => 79, 'name_en' => 'Al Sanamayn', 'name_ar' => 'الصنمين'],
            ['city_id' => 79, 'name_en' => 'Tafas', 'name_ar' => 'طفس'],
            // فرعية
            ['city_id' => 79, 'name_en' => 'Nawa', 'name_ar' => 'نوى'],
            ['city_id' => 79, 'name_en' => 'Izraa', 'name_ar' => 'إزرع'],

            // الحسكة (city_id: 80)
            // رئيسية
            ['city_id' => 80, 'name_en' => 'Downtown Al-Hasakah', 'name_ar' => 'وسط الحسكة'],
            ['city_id' => 80, 'name_en' => 'Al Nashwa', 'name_ar' => 'النشوة'],
            ['city_id' => 80, 'name_en' => 'Ras Al Ain', 'name_ar' => 'رأس العين'],
            ['city_id' => 80, 'name_en' => 'Amuda', 'name_ar' => 'عامودا'],
            // فرعية
            ['city_id' => 80, 'name_en' => 'Tell Tamer', 'name_ar' => 'تل تمر'],
            ['city_id' => 80, 'name_en' => 'Al Hol', 'name_ar' => 'الهول'],

            // ريف دمشق (city_id: 81)
            // رئيسية
            ['city_id' => 81, 'name_en' => 'Douma', 'name_ar' => 'دوما'],
            ['city_id' => 81, 'name_en' => 'Darayya', 'name_ar' => 'داريا'],
            ['city_id' => 81, 'name_en' => 'Qudsaya', 'name_ar' => 'قدسيا'],
            ['city_id' => 81, 'name_en' => 'Al Tall', 'name_ar' => 'التل'],
            // فرعية
            ['city_id' => 81, 'name_en' => 'Zabadani', 'name_ar' => 'الزبداني'],
            ['city_id' => 81, 'name_en' => 'Madaya', 'name_ar' => 'مضايا'],

            // القامشلي (city_id: 82)
            // رئيسية
            ['city_id' => 82, 'name_en' => 'Downtown Qamishli', 'name_ar' => 'وسط القامشلي'],
            ['city_id' => 82, 'name_en' => 'Al Antariyah', 'name_ar' => 'الأنطارية'],
            ['city_id' => 82, 'name_en' => 'Al Hilaliyah', 'name_ar' => 'الهلالية'],
            ['city_id' => 82, 'name_en' => 'Al Tayy', 'name_ar' => 'الطي'],
            // فرعية
            ['city_id' => 82, 'name_en' => 'Al Wusta', 'name_ar' => 'الوسطى'],
            ['city_id' => 82, 'name_en' => 'Al Zuhour', 'name_ar' => 'الزهور'],

            // حماة (city_id: 83)
            // رئيسية
            ['city_id' => 83, 'name_en' => 'Downtown Hama', 'name_ar' => 'وسط حماة'],
            ['city_id' => 83, 'name_en' => 'Al Marja', 'name_ar' => 'المرجة'],
            ['city_id' => 83, 'name_en' => 'Al Sabouniya', 'name_ar' => 'الصابونية'],
            ['city_id' => 83, 'name_en' => 'Al Muhatta', 'name_ar' => 'المحطة'],
            // فرعية
            ['city_id' => 83, 'name_en' => 'Kafr Buhum', 'name_ar' => 'كفر بهم'],
            ['city_id' => 83, 'name_en' => 'Masyaf', 'name_ar' => 'مصياف'],

            // السويداء (city_id: 84)
            // رئيسية
            ['city_id' => 84, 'name_en' => 'Downtown As-Suwayda', 'name_ar' => 'وسط السويداء'],
            ['city_id' => 84, 'name_en' => 'Al Mazraa', 'name_ar' => 'المزرعة'],
            ['city_id' => 84, 'name_en' => 'Al Qrayya', 'name_ar' => 'القريا'],
            ['city_id' => 84, 'name_en' => 'Al Mashnaqa', 'name_ar' => 'المشنقة'],
            // فرعية
            ['city_id' => 84, 'name_en' => 'Shahba', 'name_ar' => 'شهبا'],
            ['city_id' => 84, 'name_en' => 'Salkhad', 'name_ar' => 'صلخد'],

            // القنيطرة (city_id: 85)
            // رئيسية
            ['city_id' => 85, 'name_en' => 'Downtown Quneitra', 'name_ar' => 'وسط القنيطرة'],
            ['city_id' => 85, 'name_en' => 'Khan Arnabeh', 'name_ar' => 'خان أرنبة'],
            ['city_id' => 85, 'name_en' => 'Al Baath', 'name_ar' => 'البعث'],
            // فرعية
            ['city_id' => 85, 'name_en' => 'Jubata Al Khashab', 'name_ar' => 'جباتا الخشب'],
            ['city_id' => 85, 'name_en' => 'Baqqaatha', 'name_ar' => 'بقعاتا'],

            // رام الله (city_id: 86)
            // رئيسية
            ['city_id' => 86, 'name_en' => 'Al-Bireh', 'name_ar' => 'البيرة'],
            ['city_id' => 86, 'name_en' => 'Al-Tireh', 'name_ar' => 'الطيرة'],
            ['city_id' => 86, 'name_en' => 'Al-Masyoun', 'name_ar' => 'المصيون'],
            ['city_id' => 86, 'name_en' => 'Al-Irsal', 'name_ar' => 'الإرسال'],
            ['city_id' => 86, 'name_en' => 'Downtown Ramallah', 'name_ar' => 'وسط رام الله'],
            // فرعية
            ['city_id' => 86, 'name_en' => 'Beitunia', 'name_ar' => 'بيتونيا'],
            ['city_id' => 86, 'name_en' => 'Ein Misbah', 'name_ar' => 'عين مصباح'],
            ['city_id' => 86, 'name_en' => 'Um Al-Sharayet', 'name_ar' => 'أم الشرايط'],

            // نابلس (city_id: 87)
            // رئيسية
            ['city_id' => 87, 'name_en' => 'Downtown Nablus', 'name_ar' => 'وسط نابلس'],
            ['city_id' => 87, 'name_en' => 'Old City', 'name_ar' => 'البلدة القديمة'],
            ['city_id' => 87, 'name_en' => 'Rafidia', 'name_ar' => 'رفيديا'],
            ['city_id' => 87, 'name_en' => 'Al-Makhfiyya', 'name_ar' => 'المخفية'],
            ['city_id' => 87, 'name_en' => 'Al-Qaryoun', 'name_ar' => 'القريون'],
            // فرعية
            ['city_id' => 87, 'name_en' => 'Balata Camp', 'name_ar' => 'مخيم بلاطة'],
            ['city_id' => 87, 'name_en' => 'Askar Camp', 'name_ar' => 'مخيم عسكر'],
            ['city_id' => 87, 'name_en' => 'Ein Beit Al-Ma', 'name_ar' => 'عين بيت الماء'],

            // الخليل (city_id: 88)
            // رئيسية
            ['city_id' => 88, 'name_en' => 'Old City Hebron', 'name_ar' => 'البلدة القديمة الخليل'],
            ['city_id' => 88, 'name_en' => 'Bab Al-Zawiya', 'name_ar' => 'باب الزاوية'],
            ['city_id' => 88, 'name_en' => 'Wadi Al-Hariya', 'name_ar' => 'وادي الحرية'],
            ['city_id' => 88, 'name_en' => 'Al-Salam', 'name_ar' => 'السلام'],
            ['city_id' => 88, 'name_en' => 'Ras Al-Jura', 'name_ar' => 'راس الجورة'],
            // فرعية
            ['city_id' => 88, 'name_en' => 'Ain Sarah', 'name_ar' => 'عين سارة'],
            ['city_id' => 88, 'name_en' => 'Dura', 'name_ar' => 'دورا'],
            ['city_id' => 88, 'name_en' => 'Yatta', 'name_ar' => 'يطا'],

            // بيت لحم (city_id: 89)
            // رئيسية
            ['city_id' => 89, 'name_en' => 'Downtown Bethlehem', 'name_ar' => 'وسط بيت لحم'],
            ['city_id' => 89, 'name_en' => 'Beit Jala', 'name_ar' => 'بيت جالا'],
            ['city_id' => 89, 'name_en' => 'Beit Sahour', 'name_ar' => 'بيت ساحور'],
            ['city_id' => 89, 'name_en' => 'Al-Khader', 'name_ar' => 'الخضر'],
            // فرعية
            ['city_id' => 89, 'name_en' => 'Aida Camp', 'name_ar' => 'مخيم عايدة'],
            ['city_id' => 89, 'name_en' => 'Al-Dheisheh Camp', 'name_ar' => 'مخيم الدهيشة'],
            ['city_id' => 89, 'name_en' => 'Husan', 'name_ar' => 'حوسان'],

            // جنين (city_id: 90)
            // رئيسية
            ['city_id' => 90, 'name_en' => 'Downtown Jenin', 'name_ar' => 'وسط جنين'],
            ['city_id' => 90, 'name_en' => 'Jenin Camp', 'name_ar' => 'مخيم جنين'],
            ['city_id' => 90, 'name_en' => 'Al-Yamoun', 'name_ar' => 'اليامون'],
            ['city_id' => 90, 'name_en' => 'Burqin', 'name_ar' => 'برقين'],
            // فرعية
            ['city_id' => 90, 'name_en' => 'Qabatiya', 'name_ar' => 'قباطية'],
            ['city_id' => 90, 'name_en' => 'Silat Al-Harithiya', 'name_ar' => 'سيلة الحارثية'],

            // طولكرم (city_id: 91)
            // رئيسية
            ['city_id' => 91, 'name_en' => 'Downtown Tulkarem', 'name_ar' => 'وسط طولكرم'],
            ['city_id' => 91, 'name_en' => 'Tulkarem Camp', 'name_ar' => 'مخيم طولكرم'],
            ['city_id' => 91, 'name_en' => 'Anabta', 'name_ar' => 'عنبتا'],
            ['city_id' => 91, 'name_en' => 'Deir Al-Ghusun', 'name_ar' => 'دير الغصون'],
            // فرعية
            ['city_id' => 91, 'name_en' => 'Quffin', 'name_ar' => 'قفين'],
            ['city_id' => 91, 'name_en' => 'Attil', 'name_ar' => 'عتيل'],

            // قلقيلية (city_id: 92)
            // رئيسية
            ['city_id' => 92, 'name_en' => 'Downtown Qalqilya', 'name_ar' => 'وسط قلقيلية'],
            ['city_id' => 92, 'name_en' => 'Jayyous', 'name_ar' => 'جيوس'],
            ['city_id' => 92, 'name_en' => 'Azzun', 'name_ar' => 'عزون'],
            // فرعية
            ['city_id' => 92, 'name_en' => 'Hableh', 'name_ar' => 'حبلة'],
            ['city_id' => 92, 'name_en' => 'Kafr Thulth', 'name_ar' => 'كفر ثلث'],

            // غزة (city_id: 93)
            // رئيسية
            ['city_id' => 93, 'name_en' => 'Al-Rimal', 'name_ar' => 'الرمال'],
            ['city_id' => 93, 'name_en' => 'Al-Sabra', 'name_ar' => 'الصبرة'],
            ['city_id' => 93, 'name_en' => 'Al-Zaytoun', 'name_ar' => 'الزيتون'],
            ['city_id' => 93, 'name_en' => 'Al-Shuja’iyya', 'name_ar' => 'الشجاعية'],
            ['city_id' => 93, 'name_en' => 'Al-Daraj', 'name_ar' => 'الدرج'],
            // فرعية
            ['city_id' => 93, 'name_en' => 'Beach Camp', 'name_ar' => 'مخيم الشاطئ'],
            ['city_id' => 93, 'name_en' => 'Sheikh Radwan', 'name_ar' => 'الشيخ رضوان'],
            ['city_id' => 93, 'name_en' => 'Al-Nasr', 'name_ar' => 'النصر'],

            // خان يونس (city_id: 94)
            // رئيسية
            ['city_id' => 94, 'name_en' => 'Downtown Khan Yunis', 'name_ar' => 'وسط خان يونس'],
            ['city_id' => 94, 'name_en' => 'Khan Yunis Camp', 'name_ar' => 'مخيم خان يونس'],
            ['city_id' => 94, 'name_en' => 'Abasan Al-Kabira', 'name_ar' => 'عبسان الكبيرة'],
            ['city_id' => 94, 'name_en' => 'Bani Suheila', 'name_ar' => 'بني سهيلة'],
            // فرعية
            ['city_id' => 94, 'name_en' => 'Al-Qarara', 'name_ar' => 'القرارة'],
            ['city_id' => 94, 'name_en' => 'Khuza’a', 'name_ar' => 'خزاعة'],

            // رفح (city_id: 95)
            // رئيسية
            ['city_id' => 95, 'name_en' => 'Downtown Rafah', 'name_ar' => 'وسط رفح'],
            ['city_id' => 95, 'name_en' => 'Rafah Camp', 'name_ar' => 'مخيم رفح'],
            ['city_id' => 95, 'name_en' => 'Al-Shaboura', 'name_ar' => 'الشابورة'],
            ['city_id' => 95, 'name_en' => 'Tel Al-Sultan', 'name_ar' => 'تل السلطان'],
            // فرعية
            ['city_id' => 95, 'name_en' => 'Al-Bayuk', 'name_ar' => 'البيوك'],
            ['city_id' => 95, 'name_en' => 'Al-Mawasi', 'name_ar' => 'المواصي'],

            // أريحا (city_id: 96)
            // رئيسية
            ['city_id' => 96, 'name_en' => 'Downtown Jericho', 'name_ar' => 'وسط أريحا'],
            ['city_id' => 96, 'name_en' => 'Aqbat Jaber Camp', 'name_ar' => 'مخيم عقبة جبر'],
            ['city_id' => 96, 'name_en' => 'Ein Al-Sultan Camp', 'name_ar' => 'مخيم عين السلطان'],
            // فرعية
            ['city_id' => 96, 'name_en' => 'Al-Jiftlik', 'name_ar' => 'الجفتلك'],
            ['city_id' => 96, 'name_en' => 'Fasayil', 'name_ar' => 'فصايل'],

            // سلفيت (city_id: 97)
            // رئيسية
            ['city_id' => 97, 'name_en' => 'Downtown Salfit', 'name_ar' => 'وسط سلفيت'],
            ['city_id' => 97, 'name_en' => 'Biddya', 'name_ar' => 'بديا'],
            ['city_id' => 97, 'name_en' => 'Qarawat Bani Hassan', 'name_ar' => 'قراوة بني حسان'],
            // فرعية
            ['city_id' => 97, 'name_en' => 'Haris', 'name_ar' => 'حارس'],
            ['city_id' => 97, 'name_en' => 'Deir Istiya', 'name_ar' => 'دير استيا'],

            // أريئيل (city_id: 98)
            // رئيسية
            ['city_id' => 98, 'name_en' => 'Downtown Ariel', 'name_ar' => 'وسط أريئيل'],
            ['city_id' => 98, 'name_en' => 'Western Ariel', 'name_ar' => 'أريئيل الغربية'],
            ['city_id' => 98, 'name_en' => 'Eastern Ariel', 'name_ar' => 'أريئيل الشرقية'],
            // فرعية
            ['city_id' => 98, 'name_en' => 'Industrial Zone', 'name_ar' => 'المنطقة الصناعية'],

            // طوباس (city_id: 99)
            // رئيسية
            ['city_id' => 99, 'name_en' => 'Downtown Tubas', 'name_ar' => 'وسط طوباس'],
            ['city_id' => 99, 'name_en' => 'Tammun', 'name_ar' => 'تمون'],
            ['city_id' => 99, 'name_en' => 'Aqqaba', 'name_ar' => 'عقابا'],
            // فرعية
            ['city_id' => 99, 'name_en' => 'Tubas Camp', 'name_ar' => 'مخيم طوباس'],
            ['city_id' => 99, 'name_en' => 'Tayasir', 'name_ar' => 'تياسير'],

            // بني نعيم (city_id: 100)
            // رئيسية
            ['city_id' => 100, 'name_en' => 'Downtown Bani Naim', 'name_ar' => 'وسط بني نعيم'],
            ['city_id' => 100, 'name_en' => 'Al-Masakin', 'name_ar' => 'المساكن'],
            ['city_id' => 100, 'name_en' => 'Al-Jamous', 'name_ar' => 'الجاموس'],
            // فرعية
            ['city_id' => 100, 'name_en' => 'Berrin', 'name_ar' => 'برين'],
            ['city_id' => 100, 'name_en' => 'Al-Tahsa', 'name_ar' => 'التحصا'],

            // القدس الشرقية (city_id: 101)
            // رئيسية
            ['city_id' => 101, 'name_en' => 'Old City Jerusalem', 'name_ar' => 'البلدة القديمة القدس'],
            ['city_id' => 101, 'name_en' => 'Sheikh Jarrah', 'name_ar' => 'الشيخ جراح'],
            ['city_id' => 101, 'name_en' => 'Silwan', 'name_ar' => 'سلوان'],
            ['city_id' => 101, 'name_en' => 'Jabal Al-Mukaber', 'name_ar' => 'جبل المكبر'],
            ['city_id' => 101, 'name_en' => 'Al-Eizariya', 'name_ar' => 'العيزرية'],
            // فرعية
            ['city_id' => 101, 'name_en' => 'Shuafat Camp', 'name_ar' => 'مخيم شعفاط'],
            ['city_id' => 101, 'name_en' => 'Ras Al-Amud', 'name_ar' => 'راس العامود'],
            ['city_id' => 101, 'name_en' => 'Abu Dis', 'name_ar' => 'أبو ديس'],

            // دير البلح (city_id: 102)
            // رئيسية
            ['city_id' => 102, 'name_en' => 'Downtown Deir al-Balah', 'name_ar' => 'وسط دير البلح'],
            ['city_id' => 102, 'name_en' => 'Deir al-Balah Camp', 'name_ar' => 'مخيم دير البلح'],
            ['city_id' => 102, 'name_en' => 'Al-Maghraqa', 'name_ar' => 'المغراقة'],
            ['city_id' => 102, 'name_en' => 'Al-Bureij', 'name_ar' => 'البريج'],
            // فرعية
            ['city_id' => 102, 'name_en' => 'Nuseirat Camp', 'name_ar' => 'مخيم النصيرات'],
            ['city_id' => 102, 'name_en' => 'Al-Musaddar', 'name_ar' => 'المصدر'],

            // شمال غزة (city_id: 103)
            // رئيسية
            ['city_id' => 103, 'name_en' => 'Jabalia', 'name_ar' => 'جباليا'],
            ['city_id' => 103, 'name_en' => 'Jabalia Camp', 'name_ar' => 'مخيم جباليا'],
            ['city_id' => 103, 'name_en' => 'Beit Lahia', 'name_ar' => 'بيت لاهيا'],
            ['city_id' => 103, 'name_en' => 'Beit Hanoun', 'name_ar' => 'بيت حانون'],
            // فرعية
            ['city_id' => 103, 'name_en' => 'Al-Saftawi', 'name_ar' => 'السفتاوي'],
            ['city_id' => 103, 'name_en' => 'Izbat Beit Hanoun', 'name_ar' => 'عزبة بيت حانون'],

            // بغداد (city_id: 104)
            // رئيسية
            ['city_id' => 104, 'name_en' => 'Karkh', 'name_ar' => 'الكرخ'],
            ['city_id' => 104, 'name_en' => 'Rusafa', 'name_ar' => 'الرصافة'],
            ['city_id' => 104, 'name_en' => 'Adhamiyah', 'name_ar' => 'الأعظمية'],
            ['city_id' => 104, 'name_en' => 'Mansour', 'name_ar' => 'المنصور'],
            ['city_id' => 104, 'name_en' => 'Sadr City', 'name_ar' => 'مدينة الصدر'],
            ['city_id' => 104, 'name_en' => 'Kadhimiya', 'name_ar' => 'الكاظمية'],
            ['city_id' => 104, 'name_en' => 'Al-Rashid', 'name_ar' => 'الرشيد'],
            // فرعية
            ['city_id' => 104, 'name_en' => 'Al-Jadida', 'name_ar' => 'الجديدة'],
            ['city_id' => 104, 'name_en' => 'Al-Shaab', 'name_ar' => 'الشعب'],
            ['city_id' => 104, 'name_en' => 'Al-Ghazaliya', 'name_ar' => 'الغزالية'],
            ['city_id' => 104, 'name_en' => 'Al-Dora', 'name_ar' => 'الدورة'],

            // البصرة (city_id: 105)
            // رئيسية
            ['city_id' => 105, 'name_en' => 'Al-Basra Al-Qadima', 'name_ar' => 'البصرة القديمة'],
            ['city_id' => 105, 'name_en' => 'Al-Ashar', 'name_ar' => 'العشار'],
            ['city_id' => 105, 'name_en' => 'Al-Zubair', 'name_ar' => 'الزبير'],
            ['city_id' => 105, 'name_en' => 'Al-Maqal', 'name_ar' => 'المعقل'],
            ['city_id' => 105, 'name_en' => 'Al-Qurna', 'name_ar' => 'القرنة'],
            ['city_id' => 105, 'name_en' => 'Al-Faw', 'name_ar' => 'الفاو'],
            // فرعية
            ['city_id' => 105, 'name_en' => 'Al-Jumhuriya', 'name_ar' => 'الجمهورية'],
            ['city_id' => 105, 'name_en' => 'Al-Hartha', 'name_ar' => 'الهارثة'],
            ['city_id' => 105, 'name_en' => 'Shatt Al-Arab', 'name_ar' => 'شط العرب'],

            // الموصل (city_id: 106)
            // رئيسية
            ['city_id' => 106, 'name_en' => 'Old Mosul', 'name_ar' => 'الموصل القديمة'],
            ['city_id' => 106, 'name_en' => 'Al-Ghazlani', 'name_ar' => 'الغزلاني'],
            ['city_id' => 106, 'name_en' => 'Al-Muthanna', 'name_ar' => 'المثنى'],
            ['city_id' => 106, 'name_en' => 'Al-Majmoaa', 'name_ar' => 'المجموعة'],
            ['city_id' => 106, 'name_en' => 'Al-Zanjili', 'name_ar' => 'الزنجيلي'],
            ['city_id' => 106, 'name_en' => 'Al-Sukkar', 'name_ar' => 'السكر'],
            // فرعية
            ['city_id' => 106, 'name_en' => 'Al-Faisaliya', 'name_ar' => 'الفيصلية'],
            ['city_id' => 106, 'name_en' => 'Al-Shifaa', 'name_ar' => 'الشفاء'],
            ['city_id' => 106, 'name_en' => 'Al-Dawasa', 'name_ar' => 'الدواسة'],

            // كركوك (city_id: 107)
            // رئيسية
            ['city_id' => 107, 'name_en' => 'Downtown Kirkuk', 'name_ar' => 'وسط كركوك'],
            ['city_id' => 107, 'name_en' => 'Al-Musalla', 'name_ar' => 'المصلى'],
            ['city_id' => 107, 'name_en' => 'Al-Wasiti', 'name_ar' => 'الواسطي'],
            ['city_id' => 107, 'name_en' => 'Al-Nasr', 'name_ar' => 'النصر'],
            ['city_id' => 107, 'name_en' => 'Al-Hawija', 'name_ar' => 'الحويجة'],
            // فرعية
            ['city_id' => 107, 'name_en' => 'Al-Rashad', 'name_ar' => 'الرشاد'],
            ['city_id' => 107, 'name_en' => 'Taza Khurmatu', 'name_ar' => 'تازة خورماتو'],
            ['city_id' => 107, 'name_en' => 'Al-Riyadh', 'name_ar' => 'الرياض'],

            // أربيل (city_id: 108)
            // رئيسية
            ['city_id' => 108, 'name_en' => 'Downtown Erbil', 'name_ar' => 'وسط أربيل'],
            ['city_id' => 108, 'name_en' => 'Ankawa', 'name_ar' => 'عنكاوا'],
            ['city_id' => 108, 'name_en' => 'Tayrawa', 'name_ar' => 'تايراوا'],
            ['city_id' => 108, 'name_en' => 'Brayati', 'name_ar' => 'برياتي'],
            ['city_id' => 108, 'name_en' => 'Hawar', 'name_ar' => 'هوار'],
            // فرعية
            ['city_id' => 108, 'name_en' => 'Kurdistan', 'name_ar' => 'كردستان'],
            ['city_id' => 108, 'name_en' => 'Minara', 'name_ar' => 'مينارا'],
            ['city_id' => 108, 'name_en' => 'Runaki', 'name_ar' => 'روناكي'],

            // النجف (city_id: 109)
            // رئيسية
            ['city_id' => 109, 'name_en' => 'Downtown Najaf', 'name_ar' => 'وسط النجف'],
            ['city_id' => 109, 'name_en' => 'Al-Mishraq', 'name_ar' => 'المشراق'],
            ['city_id' => 109, 'name_en' => 'Al-Hurriya', 'name_ar' => 'الحرية'],
            ['city_id' => 109, 'name_en' => 'Al-Adala', 'name_ar' => 'العدالة'],
            ['city_id' => 109, 'name_en' => 'Al-Kufa', 'name_ar' => 'الكوفة'],
            // فرعية
            ['city_id' => 109, 'name_en' => 'Al-Jamiaa', 'name_ar' => 'الجامعة'],
            ['city_id' => 109, 'name_en' => 'Al-Maydan', 'name_ar' => 'الميدان'],

            // كربلاء (city_id: 110)
            // رئيسية
            ['city_id' => 110, 'name_en' => 'Downtown Karbala', 'name_ar' => 'وسط كربلاء'],
            ['city_id' => 110, 'name_en' => 'Al-Husayniya', 'name_ar' => 'الحسينية'],
            ['city_id' => 110, 'name_en' => 'Al-Hindiya', 'name_ar' => 'الهندية'],
            ['city_id' => 110, 'name_en' => 'Al-Tuwairij', 'name_ar' => 'الطويريج'],
            ['city_id' => 110, 'name_en' => 'Al-Hurr', 'name_ar' => 'الحر'],
            // فرعية
            ['city_id' => 110, 'name_en' => 'Al-Askari', 'name_ar' => 'العسكري'],
            ['city_id' => 110, 'name_en' => 'Al-Jadid', 'name_ar' => 'الجديد'],

            // السليمانية (city_id: 111)
            // رئيسية
            ['city_id' => 111, 'name_en' => 'Downtown Sulaymaniyah', 'name_ar' => 'وسط السليمانية'],
            ['city_id' => 111, 'name_en' => 'Malik Mahmud', 'name_ar' => 'مالك محمود'],
            ['city_id' => 111, 'name_en' => 'Sarchnar', 'name_ar' => 'سرجنار'],
            ['city_id' => 111, 'name_en' => 'Bakhtiari', 'name_ar' => 'بختياري'],
            ['city_id' => 111, 'name_en' => 'Rizgari', 'name_ar' => 'رزكاري'],
            // فرعية
            ['city_id' => 111, 'name_en' => 'Kani Askan', 'name_ar' => 'كاني عسكان'],
            ['city_id' => 111, 'name_en' => 'Chwarbakh', 'name_ar' => 'چوارباخ'],
            ['city_id' => 111, 'name_en' => 'Waziran', 'name_ar' => 'وزيران'],

            // دهوك (city_id: 112)
            // رئيسية
            ['city_id' => 112, 'name_en' => 'Downtown Dohuk', 'name_ar' => 'وسط دهوك'],
            ['city_id' => 112, 'name_en' => 'Malta', 'name_ar' => 'مالطا'],
            ['city_id' => 112, 'name_en' => 'Baroshki', 'name_ar' => 'باروشكي'],
            ['city_id' => 112, 'name_en' => 'Zari', 'name_ar' => 'زاري'],
            // فرعية
            ['city_id' => 112, 'name_en' => 'Shindokha', 'name_ar' => 'شيندوخا'],
            ['city_id' => 112, 'name_en' => 'Gre Base', 'name_ar' => 'كري باس'],

            // السماوة (city_id: 113)
            // رئيسية
            ['city_id' => 113, 'name_en' => 'Downtown Samawah', 'name_ar' => 'وسط السماوة'],
            ['city_id' => 113, 'name_en' => 'Al-Muhandisin', 'name_ar' => 'المهندسين'],
            ['city_id' => 113, 'name_en' => 'Al-Shuhada', 'name_ar' => 'الشهداء'],
            ['city_id' => 113, 'name_en' => 'Al-Sadr', 'name_ar' => 'الصدر'],
            // فرعية
            ['city_id' => 113, 'name_en' => 'Al-Jazira', 'name_ar' => 'الجزيرة'],
            ['city_id' => 113, 'name_en' => 'Al-Rumaytha', 'name_ar' => 'الرميثة'],

            // الديوانية (city_id: 114)
            // رئيسية
            ['city_id' => 114, 'name_en' => 'Downtown Diwaniya', 'name_ar' => 'وسط الديوانية'],
            ['city_id' => 114, 'name_en' => 'Al-Uroba', 'name_ar' => 'العروبة'],
            ['city_id' => 114, 'name_en' => 'Al-Salam', 'name_ar' => 'السلام'],
            ['city_id' => 114, 'name_en' => 'Al-Shamiya', 'name_ar' => 'الشامية'],
            // فرعية
            ['city_id' => 114, 'name_en' => 'Al-Hamza', 'name_ar' => 'الحمزة'],
            ['city_id' => 114, 'name_en' => 'Afak', 'name_ar' => 'عفك'],

            // الناصرية (city_id: 115)
            // رئيسية
            ['city_id' => 115, 'name_en' => 'Downtown Nasiriyah', 'name_ar' => 'وسط الناصرية'],
            ['city_id' => 115, 'name_en' => 'Al-Furat', 'name_ar' => 'الفرات'],
            ['city_id' => 115, 'name_en' => 'Al-Shatra', 'name_ar' => 'الشطرة'],
            ['city_id' => 115, 'name_en' => 'Al-Nasr', 'name_ar' => 'النصر'],
            ['city_id' => 115, 'name_en' => 'Al-Gharraf', 'name_ar' => 'الغراف'],
            // فرعية
            ['city_id' => 115, 'name_en' => 'Suq Al-Shuyukh', 'name_ar' => 'سوق الشيوخ'],
            ['city_id' => 115, 'name_en' => 'Al-Rifa’i', 'name_ar' => 'الرفاعي'],

            // العمارة (city_id: 116)
            // رئيسية
            ['city_id' => 116, 'name_en' => 'Downtown Amarah', 'name_ar' => 'وسط العمارة'],
            ['city_id' => 116, 'name_en' => 'Al-Majar Al-Kabir', 'name_ar' => 'المجر الكبير'],
            ['city_id' => 116, 'name_en' => 'Al-Kahla', 'name_ar' => 'الكحلاء'],
            ['city_id' => 116, 'name_en' => 'Al-Maimouna', 'name_ar' => 'الميمونة'],
            // فرعية
            ['city_id' => 116, 'name_en' => 'Al-Ali Al-Gharbi', 'name_ar' => 'علي الغربي'],
            ['city_id' => 116, 'name_en' => 'Al-Tahrir', 'name_ar' => 'التحرير'],

            // الرمادي (city_id: 117)
            // رئيسية
            ['city_id' => 117, 'name_en' => 'Downtown Ramadi', 'name_ar' => 'وسط الرمادي'],
            ['city_id' => 117, 'name_en' => 'Al-Andalus', 'name_ar' => 'الأندلس'],
            ['city_id' => 117, 'name_en' => 'Al-Malaab', 'name_ar' => 'الملعب'],
            ['city_id' => 117, 'name_en' => 'Al-Tamim', 'name_ar' => 'التميم'],
            // فرعية
            ['city_id' => 117, 'name_en' => 'Al-Habbaniyah', 'name_ar' => 'الحبانية'],
            ['city_id' => 117, 'name_en' => 'Al-Khalidiya', 'name_ar' => 'الخالدية'],

            // تكريت (city_id: 118)
            // رئيسية
            ['city_id' => 118, 'name_en' => 'Downtown Tikrit', 'name_ar' => 'وسط تكريت'],
            ['city_id' => 118, 'name_en' => 'Al-Qadisiyah', 'name_ar' => 'القادسية'],
            ['city_id' => 118, 'name_en' => 'Al-Shishin', 'name_ar' => 'الشيشين'],
            ['city_id' => 118, 'name_en' => 'Al-Awja', 'name_ar' => 'العوجة'],
            // فرعية
            ['city_id' => 118, 'name_en' => 'Al-Dour', 'name_ar' => 'الدور'],
            ['city_id' => 118, 'name_en' => 'Al-Alam', 'name_ar' => 'العلم'],

            // بعقوبة (city_id: 119)
            // رئيسية
            ['city_id' => 119, 'name_en' => 'Downtown Baqubah', 'name_ar' => 'وسط بعقوبة'],
            ['city_id' => 119, 'name_en' => 'Al-Muqdadiyah', 'name_ar' => 'المقدادية'],
            ['city_id' => 119, 'name_en' => 'Al-Khalis', 'name_ar' => 'الخالص'],
            ['city_id' => 119, 'name_en' => 'Buhriz', 'name_ar' => 'بهرز'],
            // فرعية
            ['city_id' => 119, 'name_en' => 'Kanan', 'name_ar' => 'كنان'],
            ['city_id' => 119, 'name_en' => 'Al-Ubaidi', 'name_ar' => 'العبيدي'],

            // الكوت (city_id: 120)
            // رئيسية
            ['city_id' => 120, 'name_en' => 'Downtown Kut', 'name_ar' => 'وسط الكوت'],
            ['city_id' => 120, 'name_en' => 'Al-Hayy', 'name_ar' => 'الحي'],
            ['city_id' => 120, 'name_en' => 'Al-Numaniyah', 'name_ar' => 'النعمانية'],
            ['city_id' => 120, 'name_en' => 'Al-Suwaira', 'name_ar' => 'الصويرة'],
            // فرعية
            ['city_id' => 120, 'name_en' => 'Al-Azezia', 'name_ar' => 'العزيزية'],
            ['city_id' => 120, 'name_en' => 'Badra', 'name_ar' => 'بدرة'],

            // حلبجة (city_id: 121)
            // رئيسية
            ['city_id' => 121, 'name_en' => 'Downtown Halabja', 'name_ar' => 'وسط حلبجة'],
            ['city_id' => 121, 'name_en' => 'Sirwan', 'name_ar' => 'سيروان'],
            ['city_id' => 121, 'name_en' => 'Khormal', 'name_ar' => 'خورمال'],
            ['city_id' => 121, 'name_en' => 'Byara', 'name_ar' => 'بيارة'],
            // فرعية
            ['city_id' => 121, 'name_en' => 'Tawella', 'name_ar' => 'طويلة'],
            ['city_id' => 121, 'name_en' => 'Said Sadiq', 'name_ar' => 'سعيد صادق'],
            // الرياض (city_id: 122)
            // رئيسية
            ['city_id' => 122, 'name_en' => 'Al Olaya', 'name_ar' => 'العليا'],
            ['city_id' => 122, 'name_en' => 'Al Malaz', 'name_ar' => 'الملز'],
            ['city_id' => 122, 'name_en' => 'Al Sulaymaniyah', 'name_ar' => 'السليمانية'],
            ['city_id' => 122, 'name_en' => 'Al Naseem', 'name_ar' => 'النظيم'],
            ['city_id' => 122, 'name_en' => 'Al Rawdah', 'name_ar' => 'الروضة'],
            ['city_id' => 122, 'name_en' => 'Al Shifa', 'name_ar' => 'الشفاء'],
            ['city_id' => 122, 'name_en' => 'Al Murooj', 'name_ar' => 'المروج'],
            // فرعية
            ['city_id' => 122, 'name_en' => 'Al Rabwah', 'name_ar' => 'الربوة'],
            ['city_id' => 122, 'name_en' => 'Al Izdihar', 'name_ar' => 'الإزدهار'],
            ['city_id' => 122, 'name_en' => 'Al Wurud', 'name_ar' => 'الورود'],
            ['city_id' => 122, 'name_en' => 'Al Namudhajiyah', 'name_ar' => 'النموذجية'],

            // جدة (city_id: 123)
            // رئيسية
            ['city_id' => 123, 'name_en' => 'Al Hamra', 'name_ar' => 'الحمراء'],
            ['city_id' => 123, 'name_en' => 'Al Ruwais', 'name_ar' => 'الرويس'],
            ['city_id' => 123, 'name_en' => 'Al Andalus', 'name_ar' => 'الأندلس'],
            ['city_id' => 123, 'name_en' => 'Al Bawadi', 'name_ar' => 'البوادي'],
            ['city_id' => 123, 'name_en' => 'Al Zahra', 'name_ar' => 'الزهراء'],
            ['city_id' => 123, 'name_en' => 'Al Rawdah', 'name_ar' => 'الروضة'],
            // فرعية
            ['city_id' => 123, 'name_en' => 'Al Salamah', 'name_ar' => 'السلامة'],
            ['city_id' => 123, 'name_en' => 'Al Naeem', 'name_ar' => 'النعيم'],
            ['city_id' => 123, 'name_en' => 'Al Rabwah', 'name_ar' => 'الربوة'],
            ['city_id' => 123, 'name_en' => 'Al Safa', 'name_ar' => 'الصفا'],

            // مكة (city_id: 124)
            // رئيسية
            ['city_id' => 124, 'name_en' => 'Al Aziziyah', 'name_ar' => 'العزيزية'],
            ['city_id' => 124, 'name_en' => 'Al Sharaie', 'name_ar' => 'الشرايع'],
            ['city_id' => 124, 'name_en' => 'Al Naseem', 'name_ar' => 'النظيم'],
            ['city_id' => 124, 'name_en' => 'Al Rawabi', 'name_ar' => 'الروابي'],
            ['city_id' => 124, 'name_en' => 'Al Zaydi', 'name_ar' => 'الزايدي'],
            ['city_id' => 124, 'name_en' => 'Al Haram', 'name_ar' => 'الحرم'],
            // فرعية
            ['city_id' => 124, 'name_en' => 'Al Shoqiyah', 'name_ar' => 'الشوقية'],
            ['city_id' => 124, 'name_en' => 'Al Awali', 'name_ar' => 'العوالي'],
            ['city_id' => 124, 'name_en' => 'Al Hindawiyah', 'name_ar' => 'الهنداوية'],

            // المدينة المنورة (city_id: 125)
            // رئيسية
            ['city_id' => 125, 'name_en' => 'Al Haram', 'name_ar' => 'الحرم'],
            ['city_id' => 125, 'name_en' => 'Al Quba', 'name_ar' => 'القباء'],
            ['city_id' => 125, 'name_en' => 'Al Aziziyah', 'name_ar' => 'العزيزية'],
            ['city_id' => 125, 'name_en' => 'Al Sitten', 'name_ar' => 'الستين'],
            ['city_id' => 125, 'name_en' => 'Al Khalidiyah', 'name_ar' => 'الخالدية'],
            ['city_id' => 125, 'name_en' => 'Al Rawabi', 'name_ar' => 'الروابي'],
            // فرعية
            ['city_id' => 125, 'name_en' => 'Al Hezam', 'name_ar' => 'الحزام'],
            ['city_id' => 125, 'name_en' => 'Al Aridh', 'name_ar' => 'العريض'],
            ['city_id' => 125, 'name_en' => 'Al Mahjar', 'name_ar' => 'المهجر'],

            // الدمام (city_id: 126)
            // رئيسية
            ['city_id' => 126, 'name_en' => 'Al Corniche', 'name_ar' => 'الكورنيش'],
            ['city_id' => 126, 'name_en' => 'Al Shati', 'name_ar' => 'الشاطئ'],
            ['city_id' => 126, 'name_en' => 'Al Muhammadiyah', 'name_ar' => 'المحمدية'],
            ['city_id' => 126, 'name_en' => 'Al Faisaliyah', 'name_ar' => 'الفيصلية'],
            ['city_id' => 126, 'name_en' => 'Al Aziziyah', 'name_ar' => 'العزيزية'],
            ['city_id' => 126, 'name_en' => 'Al Nakheel', 'name_ar' => 'النخيل'],
            // فرعية
            ['city_id' => 126, 'name_en' => 'Al Mazruiyah', 'name_ar' => 'المزرعية'],
            ['city_id' => 126, 'name_en' => 'Al Badia', 'name_ar' => 'البديع'],
            ['city_id' => 126, 'name_en' => 'Al Jalawiyah', 'name_ar' => 'الجلوية'],

            // الخبر (city_id: 127)
            // رئيسية
            ['city_id' => 127, 'name_en' => 'Al Khobar Al Shamalia', 'name_ar' => 'الخبر الشمالية'],
            ['city_id' => 127, 'name_en' => 'Al Khobar Al Janubia', 'name_ar' => 'الخبر الجنوبية'],
            ['city_id' => 127, 'name_en' => 'Al Thuqbah', 'name_ar' => 'الثقبة'],
            ['city_id' => 127, 'name_en' => 'Al Bandariyah', 'name_ar' => 'البندرية'],
            ['city_id' => 127, 'name_en' => 'Al Olaya', 'name_ar' => 'العليا'],
            // فرعية
            ['city_id' => 127, 'name_en' => 'Al Rakah', 'name_ar' => 'الراكة'],
            ['city_id' => 127, 'name_en' => 'Al Hizam Al Akhdar', 'name_ar' => 'الحزام الأخضر'],
            ['city_id' => 127, 'name_en' => 'Al Aqrabiyah', 'name_ar' => 'العقربية'],

            // الطائف (city_id: 128)
            // رئيسية
            ['city_id' => 128, 'name_en' => 'Al Hawiyah', 'name_ar' => 'الحوية'],
            ['city_id' => 128, 'name_en' => 'Al Shifa', 'name_ar' => 'الشفا'],
            ['city_id' => 128, 'name_en' => 'Al Qutbiyyah', 'name_ar' => 'القطبية'],
            ['city_id' => 128, 'name_en' => 'Al Salama', 'name_ar' => 'السلامة'],
            ['city_id' => 128, 'name_en' => 'Al Rudaf', 'name_ar' => 'الردف'],
            // فرعية
            ['city_id' => 128, 'name_en' => 'Al Nakhab', 'name_ar' => 'النخب'],
            ['city_id' => 128, 'name_en' => 'Al Sayl', 'name_ar' => 'السيل'],
            ['city_id' => 128, 'name_en' => 'Al Masarrah', 'name_ar' => 'المسرة'],

            // أبها (city_id: 129)
            // رئيسية
            ['city_id' => 129, 'name_en' => 'Al Mansak', 'name_ar' => 'المنسك'],
            ['city_id' => 129, 'name_en' => 'Al Shifa', 'name_ar' => 'الشفا'],
            ['city_id' => 129, 'name_en' => 'Al Murooj', 'name_ar' => 'المروج'],
            ['city_id' => 129, 'name_en' => 'Al Mahalah', 'name_ar' => 'المحالة'],
            ['city_id' => 129, 'name_en' => 'Al Aziziyah', 'name_ar' => 'العزيزية'],
            // فرعية
            ['city_id' => 129, 'name_en' => 'Al Wadi', 'name_ar' => 'الوادي'],
            ['city_id' => 129, 'name_en' => 'Al Rabwah', 'name_ar' => 'الربوة'],
            ['city_id' => 129, 'name_en' => 'Al Khalidiyah', 'name_ar' => 'الخالدية'],

            // بريدة (city_id: 130)
            // رئيسية
            ['city_id' => 130, 'name_en' => 'Al Safra', 'name_ar' => 'الصفراء'],
            ['city_id' => 130, 'name_en' => 'Al Rawabi', 'name_ar' => 'الروابي'],
            ['city_id' => 130, 'name_en' => 'Al Bukayriyah', 'name_ar' => 'البكيرية'],
            ['city_id' => 130, 'name_en' => 'Al Shimasiyah', 'name_ar' => 'الشماسية'],
            ['city_id' => 130, 'name_en' => 'Al Rabwah', 'name_ar' => 'الربوة'],
            // فرعية
            ['city_id' => 130, 'name_en' => 'Al Khubayb', 'name_ar' => 'الخبيب'],
            ['city_id' => 130, 'name_en' => 'Al Rayan', 'name_ar' => 'الريان'],
            ['city_id' => 130, 'name_en' => 'Al Fayziyah', 'name_ar' => 'الفايزية'],

            // خميس مشيط (city_id: 131)
            // رئيسية
            ['city_id' => 131, 'name_en' => 'Al Rabwah', 'name_ar' => 'الربوة'],
            ['city_id' => 131, 'name_en' => 'Al Shifa', 'name_ar' => 'الشفا'],
            ['city_id' => 131, 'name_en' => 'Al Matar', 'name_ar' => 'المطار'],
            ['city_id' => 131, 'name_en' => 'Al Aziziyah', 'name_ar' => 'العزيزية'],
            ['city_id' => 131, 'name_en' => 'Al Rawdah', 'name_ar' => 'الروضة'],
            // فرعية
            ['city_id' => 131, 'name_en' => 'Al Naseem', 'name_ar' => 'النظيم'],
            ['city_id' => 131, 'name_en' => 'Al Khalidiyah', 'name_ar' => 'الخالدية'],
            ['city_id' => 131, 'name_en' => 'Al Muntazah', 'name_ar' => 'المنتزه'],

            // نجران (city_id: 132)
            // رئيسية
            ['city_id' => 132, 'name_en' => 'Al Shurafa', 'name_ar' => 'الشرفة'],
            ['city_id' => 132, 'name_en' => 'Al Fahad', 'name_ar' => 'الفهد'],
            ['city_id' => 132, 'name_en' => 'Al Rawdah', 'name_ar' => 'الروضة'],
            ['city_id' => 132, 'name_en' => 'Al Naseem', 'name_ar' => 'النظيم'],
            // فرعية
            ['city_id' => 132, 'name_en' => 'Al Qabil', 'name_ar' => 'القابل'],
            ['city_id' => 132, 'name_en' => 'Al Hadn', 'name_ar' => 'الهضن'],
            ['city_id' => 132, 'name_en' => 'Al Akhdoud', 'name_ar' => 'الأخدود'],

            // حائل (city_id: 133)
            // رئيسية
            ['city_id' => 133, 'name_en' => 'Al Suwairi', 'name_ar' => 'الصويري'],
            ['city_id' => 133, 'name_en' => 'Al Muntazah', 'name_ar' => 'المنتزه'],
            ['city_id' => 133, 'name_en' => 'Al Rawdah', 'name_ar' => 'الروضة'],
            ['city_id' => 133, 'name_en' => 'Al Aziziyah', 'name_ar' => 'العزيزية'],
            ['city_id' => 133, 'name_en' => 'Al Shifa', 'name_ar' => 'الشفا'],
            // فرعية
            ['city_id' => 133, 'name_en' => 'Al Wadi', 'name_ar' => 'الوادي'],
            ['city_id' => 133, 'name_en' => 'Al Mahatta', 'name_ar' => 'المحطة'],

            // الجبيل (city_id: 134)
            // رئيسية
            ['city_id' => 134, 'name_en' => 'Jubail Industrial City', 'name_ar' => 'مدينة الجبيل الصناعية'],
            ['city_id' => 134, 'name_en' => 'Jubail Al Balad', 'name_ar' => 'الجبيل البلد'],
            ['city_id' => 134, 'name_en' => 'Al Fanateer', 'name_ar' => 'الفناتير'],
            ['city_id' => 134, 'name_en' => 'Al Huwaylat', 'name_ar' => 'الحويلات'],
            ['city_id' => 134, 'name_en' => 'Al Dafi', 'name_ar' => 'الدفي'],
            // فرعية
            ['city_id' => 134, 'name_en' => 'Al Jalmudah', 'name_ar' => 'الجلمودة'],
            ['city_id' => 134, 'name_en' => 'Al Nakheel', 'name_ar' => 'النخيل'],

            // ينبع (city_id: 135)
            // رئيسية
            ['city_id' => 135, 'name_en' => 'Yanbu Al Balad', 'name_ar' => 'ينبع البلد'],
            ['city_id' => 135, 'name_en' => 'Yanbu Industrial City', 'name_ar' => 'مدينة ينبع الصناعية'],
            ['city_id' => 135, 'name_en' => 'Al Nakheel', 'name_ar' => 'النخيل'],
            ['city_id' => 135, 'name_en' => 'Al Samir', 'name_ar' => 'السمير'],
            // فرعية
            ['city_id' => 135, 'name_en' => 'Al Rabwah', 'name_ar' => 'الربوة'],
            ['city_id' => 135, 'name_en' => 'Al Shurooq', 'name_ar' => 'الشروق'],

            // الأحساء (city_id: 136)
            // رئيسية
            ['city_id' => 136, 'name_en' => 'Al Hofuf', 'name_ar' => 'الهفوف'],
            ['city_id' => 136, 'name_en' => 'Al Mubarraz', 'name_ar' => 'المبرز'],
            ['city_id' => 136, 'name_en' => 'Al Oyoun', 'name_ar' => 'العيون'],
            ['city_id' => 136, 'name_en' => 'Al Mahasin', 'name_ar' => 'المحاسن'],
            ['city_id' => 136, 'name_en' => 'Al Salmaniyah', 'name_ar' => 'السلمانية'],
            // فرعية
            ['city_id' => 136, 'name_en' => 'Al Fateh', 'name_ar' => 'الفتح'],
            ['city_id' => 136, 'name_en' => 'Al Rawdah', 'name_ar' => 'الروضة'],
            ['city_id' => 136, 'name_en' => 'Al Naathal', 'name_ar' => 'النعاثل'],

            // القطيف (city_id: 137)
            // رئيسية
            ['city_id' => 137, 'name_en' => 'Al Qatif City', 'name_ar' => 'مدينة القطيف'],
            ['city_id' => 137, 'name_en' => 'Tarout', 'name_ar' => 'تاروت'],
            ['city_id' => 137, 'name_en' => 'Saihat', 'name_ar' => 'سيهات'],
            ['city_id' => 137, 'name_en' => 'Safwa', 'name_ar' => 'صفوى'],
            // فرعية
            ['city_id' => 137, 'name_en' => 'Anak', 'name_ar' => 'عنك'],
            ['city_id' => 137, 'name_en' => 'Al Awjam', 'name_ar' => 'العوام'],

            // عرعر (city_id: 138)
            // رئيسية
            ['city_id' => 138, 'name_en' => 'Al Naseem', 'name_ar' => 'النظيم'],
            ['city_id' => 138, 'name_en' => 'Al Rawdah', 'name_ar' => 'الروضة'],
            ['city_id' => 138, 'name_en' => 'Al Murooj', 'name_ar' => 'المروج'],
            ['city_id' => 138, 'name_en' => 'Al Mansouriyah', 'name_ar' => 'المنصورية'],
            // فرعية
            ['city_id' => 138, 'name_en' => 'Al Rabwah', 'name_ar' => 'الربوة'],
            ['city_id' => 138, 'name_en' => 'Al Khalidiyah', 'name_ar' => 'الخالدية'],

            // الخرج (city_id: 139)
            // رئيسية
            ['city_id' => 139, 'name_en' => 'Al Naseem', 'name_ar' => 'النظيم'],
            ['city_id' => 139, 'name_en' => 'Al Yamamah', 'name_ar' => 'اليمامة'],
            ['city_id' => 139, 'name_en' => 'Al Aziziyah', 'name_ar' => 'العزيزية'],
            ['city_id' => 139, 'name_en' => 'Al Sulaymaniyah', 'name_ar' => 'السليمانية'],
            // فرعية
            ['city_id' => 139, 'name_en' => 'Al Rawdah', 'name_ar' => 'الروضة'],
            ['city_id' => 139, 'name_en' => 'Al Khalidiyah', 'name_ar' => 'الخالدية'],

            // تبوك (city_id: 140)
            // رئيسية
            ['city_id' => 140, 'name_en' => 'Al Murooj', 'name_ar' => 'المروج'],
            ['city_id' => 140, 'name_en' => 'Al Rawdah', 'name_ar' => 'الروضة'],
            ['city_id' => 140, 'name_en' => 'Al Aziziyah', 'name_ar' => 'العزيزية'],
            ['city_id' => 140, 'name_en' => 'Al Ulaya', 'name_ar' => 'العليا'],
            ['city_id' => 140, 'name_en' => 'Al Naseem', 'name_ar' => 'النظيم'],
            // فرعية
            ['city_id' => 140, 'name_en' => 'Al Rabwah', 'name_ar' => 'الربوة'],
            ['city_id' => 140, 'name_en' => 'Al Khalidiyah', 'name_ar' => 'الخالدية'],

            // جازان (city_id: 141)
            // رئيسية
            ['city_id' => 141, 'name_en' => 'Al Suwais', 'name_ar' => 'السويس'],
            ['city_id' => 141, 'name_en' => 'Al Rawdah', 'name_ar' => 'الروضة'],
            ['city_id' => 141, 'name_en' => 'Al Shati', 'name_ar' => 'الشاطئ'],
            ['city_id' => 141, 'name_en' => 'Al Matar', 'name_ar' => 'المطار'],
            // فرعية
            ['city_id' => 141, 'name_en' => 'Al Rabwah', 'name_ar' => 'الربوة'],
            ['city_id' => 141, 'name_en' => 'Al Naseem', 'name_ar' => 'النظيم'],

            // الباحة (city_id: 142)
            // رئيسية
            ['city_id' => 142, 'name_en' => 'Al Rawdah', 'name_ar' => 'الروضة'],
            ['city_id' => 142, 'name_en' => 'Al Makhwah', 'name_ar' => 'المخواة'],
            ['city_id' => 142, 'name_en' => 'Al Aqiq', 'name_ar' => 'العقيق'],
            ['city_id' => 142, 'name_en' => 'Al Qura', 'name_ar' => 'القرى'],
            // فرعية
            ['city_id' => 142, 'name_en' => 'Al Naseem', 'name_ar' => 'النظيم'],
            ['city_id' => 142, 'name_en' => 'Al Balad', 'name_ar' => 'البلد'],

            // الظهران (city_id: 143)
            // رئيسية
            ['city_id' => 143, 'name_en' => 'Dhahran Main', 'name_ar' => 'الظهران الرئيسية'],
            ['city_id' => 143, 'name_en' => 'Aramco Camp', 'name_ar' => 'معسكر أرامكو'],
            ['city_id' => 143, 'name_en' => 'Al Doha', 'name_ar' => 'الدوحة'],
            ['city_id' => 143, 'name_en' => 'Al Dana', 'name_ar' => 'الدانة'],
            // فرعية
            ['city_id' => 143, 'name_en' => 'Al Bustan', 'name_ar' => 'البستان'],
            ['city_id' => 143, 'name_en' => 'Al Rawdah', 'name_ar' => 'الروضة'],

            // حفر الباطن (city_id: 144)
            // رئيسية
            ['city_id' => 144, 'name_en' => 'Al Aziziyah', 'name_ar' => 'العزيزية'],
            ['city_id' => 144, 'name_en' => 'Al Rawdah', 'name_ar' => 'الروضة'],
            ['city_id' => 144, 'name_en' => 'Al Naseem', 'name_ar' => 'النظيم'],
            ['city_id' => 144, 'name_en' => 'Al Sulaymaniyah', 'name_ar' => 'السليمانية'],
            ['city_id' => 144, 'name_en' => 'Al Murooj', 'name_ar' => 'المروج'],
            // فرعية
            ['city_id' => 144, 'name_en' => 'Al Rabwah', 'name_ar' => 'الربوة'],
            ['city_id' => 144, 'name_en' => 'Al Khalidiyah', 'name_ar' => 'الخالدية'],
            // أبو ظبي (city_id: 145)
            // رئيسية
            ['city_id' => 145, 'name_en' => 'Al Khalidiyah', 'name_ar' => 'الخالدية'],
            ['city_id' => 145, 'name_en' => 'Al Bateen', 'name_ar' => 'البطين'],
            ['city_id' => 145, 'name_en' => 'Al Mushrif', 'name_ar' => 'المشريف'],
            ['city_id' => 145, 'name_en' => 'Al Reem Island', 'name_ar' => 'جزيرة الريم'],
            ['city_id' => 145, 'name_en' => 'Saadiyat Island', 'name_ar' => 'جزيرة السعديات'],
            ['city_id' => 145, 'name_en' => 'Yas Island', 'name_ar' => 'جزيرة ياس'],
            ['city_id' => 145, 'name_en' => 'Khalifa City', 'name_ar' => 'مدينة خليفة'],
            ['city_id' => 145, 'name_en' => 'Madinat Zayed', 'name_ar' => 'مدينة زايد'],
            // فرعية
            ['city_id' => 145, 'name_en' => 'Al Manhal', 'name_ar' => 'المنهل'],
            ['city_id' => 145, 'name_en' => 'Al Nahyan', 'name_ar' => 'النهيان'],
            ['city_id' => 145, 'name_en' => 'Al Dhafra', 'name_ar' => 'الظفرة'],
            ['city_id' => 145, 'name_en' => 'Mussafah', 'name_ar' => 'مصفح'],
            ['city_id' => 145, 'name_en' => 'Al Maqtaa', 'name_ar' => 'المقطع'],

            // دبي (city_id: 146)
            // رئيسية
            ['city_id' => 146, 'name_en' => 'Downtown Dubai', 'name_ar' => 'وسط دبي'],
            ['city_id' => 146, 'name_en' => 'Dubai Marina', 'name_ar' => 'مارينا دبي'],
            ['city_id' => 146, 'name_en' => 'Jumeirah', 'name_ar' => 'جميرا'],
            ['city_id' => 146, 'name_en' => 'Deira', 'name_ar' => 'ديرة'],
            ['city_id' => 146, 'name_en' => 'Bur Dubai', 'name_ar' => 'بر دبي'],
            ['city_id' => 146, 'name_en' => 'Business Bay', 'name_ar' => 'خليج الأعمال'],
            ['city_id' => 146, 'name_en' => 'Palm Jumeirah', 'name_ar' => 'نخلة جميرا'],
            ['city_id' => 146, 'name_en' => 'Sheikh Zayed Road', 'name_ar' => 'شارع الشيخ زايد'],
            // فرعية
            ['city_id' => 146, 'name_en' => 'Al Barsha', 'name_ar' => 'البرشاء'],
            ['city_id' => 146, 'name_en' => 'Al Quoz', 'name_ar' => 'القوز'],
            ['city_id' => 146, 'name_en' => 'Jebel Ali', 'name_ar' => 'جبل علي'],
            ['city_id' => 146, 'name_en' => 'Al Satwa', 'name_ar' => 'السطوة'],
            ['city_id' => 146, 'name_en' => 'Dubai Silicon Oasis', 'name_ar' => 'واحة دبي للسيليكون'],

            // الشارقة (city_id: 147)
            // رئيسية
            ['city_id' => 147, 'name_en' => 'Al Majaz', 'name_ar' => 'المجاز'],
            ['city_id' => 147, 'name_en' => 'Al Nahda', 'name_ar' => 'النهدة'],
            ['city_id' => 147, 'name_en' => 'Al Qasimia', 'name_ar' => 'القاسمية'],
            ['city_id' => 147, 'name_en' => 'Al Layyah', 'name_ar' => 'اللية'],
            ['city_id' => 147, 'name_en' => 'Muwaileh', 'name_ar' => 'مويلح'],
            ['city_id' => 147, 'name_en' => 'Al Khan', 'name_ar' => 'الخان'],
            ['city_id' => 147, 'name_en' => 'Al Taawun', 'name_ar' => 'التعاون'],
            // فرعية
            ['city_id' => 147, 'name_en' => 'Al Yarmouk', 'name_ar' => 'اليرموك'],
            ['city_id' => 147, 'name_en' => 'Al Sabkha', 'name_ar' => 'الصبخة'],
            ['city_id' => 147, 'name_en' => 'Al Musalla', 'name_ar' => 'المصلى'],
            ['city_id' => 147, 'name_en' => 'Al Gharayen', 'name_ar' => 'الغراين'],

            // عجمان (city_id: 148)
            // رئيسية
            ['city_id' => 148, 'name_en' => 'Al Nuaimiya', 'name_ar' => 'النعيمية'],
            ['city_id' => 148, 'name_en' => 'Al Rashidiya', 'name_ar' => 'الراشدية'],
            ['city_id' => 148, 'name_en' => 'Al Jurf', 'name_ar' => 'الجرف'],
            ['city_id' => 148, 'name_en' => 'Al Mowaihat', 'name_ar' => 'المويهات'],
            ['city_id' => 148, 'name_en' => 'Al Zahra', 'name_ar' => 'الزهراء'],
            // فرعية
            ['city_id' => 148, 'name_en' => 'Al Bustan', 'name_ar' => 'البستان'],
            ['city_id' => 148, 'name_en' => 'Al Rawda', 'name_ar' => 'الروضة'],
            ['city_id' => 148, 'name_en' => 'Al Hamriya', 'name_ar' => 'الحمرية'],

            // أم القيوين (city_id: 149)
            // رئيسية
            ['city_id' => 149, 'name_en' => 'Al Salama', 'name_ar' => 'السلامة'],
            ['city_id' => 149, 'name_en' => 'Al Raas', 'name_ar' => 'الراس'],
            ['city_id' => 149, 'name_en' => 'Al Maidan', 'name_ar' => 'الميدان'],
            ['city_id' => 149, 'name_en' => 'Al Dar Al Baida', 'name_ar' => 'الدار البيضاء'],
            // فرعية
            ['city_id' => 149, 'name_en' => 'Al Riqqah', 'name_ar' => 'الرقة'],
            ['city_id' => 149, 'name_en' => 'Al Humrah', 'name_ar' => 'الحمرة'],

            // الفجيرة (city_id: 150)
            // رئيسية
            ['city_id' => 150, 'name_en' => 'Al Faseel', 'name_ar' => 'الفصيل'],
            ['city_id' => 150, 'name_en' => 'Al Mahatta', 'name_ar' => 'المحطة'],
            ['city_id' => 150, 'name_en' => 'Murbah', 'name_ar' => 'مربح'],
            ['city_id' => 150, 'name_en' => 'Al Hayl', 'name_ar' => 'الهيل'],
            // فرعية
            ['city_id' => 150, 'name_en' => 'Sakamkam', 'name_ar' => 'سكمكم'],
            ['city_id' => 150, 'name_en' => 'Al Taween', 'name_ar' => 'الطوين'],

            // رأس الخيمة (city_id: 151)
            // رئيسية
            ['city_id' => 151, 'name_en' => 'Al Nakheel', 'name_ar' => 'النخيل'],
            ['city_id' => 151, 'name_en' => 'Al Dhait', 'name_ar' => 'الظيت'],
            ['city_id' => 151, 'name_en' => 'Al Mamourah', 'name_ar' => 'المعمورة'],
            ['city_id' => 151, 'name_en' => 'Khuzam', 'name_ar' => 'خزام'],
            ['city_id' => 151, 'name_en' => 'Al Seih', 'name_ar' => 'السيح'],
            // فرعية
            ['city_id' => 151, 'name_en' => 'Al Hamraniyah', 'name_ar' => 'الحمرانية'],
            ['city_id' => 151, 'name_en' => 'Al Qusaidat', 'name_ar' => 'القصيدات'],
            ['city_id' => 151, 'name_en' => 'Al Juwais', 'name_ar' => 'الجويس'],

            // العين (city_id: 152)
            // رئيسية
            ['city_id' => 152, 'name_en' => 'Al Muwaiji', 'name_ar' => 'المويجعي'],
            ['city_id' => 152, 'name_en' => 'Al Jimi', 'name_ar' => 'الجيمي'],
            ['city_id' => 152, 'name_en' => 'Al Qattara', 'name_ar' => 'القطارة'],
            ['city_id' => 152, 'name_en' => 'Al Hili', 'name_ar' => 'الهيلي'],
            ['city_id' => 152, 'name_en' => 'Al Mutawaa', 'name_ar' => 'المعترض'],
            ['city_id' => 152, 'name_en' => 'Al Towayya', 'name_ar' => 'الطوية'],
            ['city_id' => 152, 'name_en' => 'Al Maqam', 'name_ar' => 'المقام'],
            // فرعية
            ['city_id' => 152, 'name_en' => 'Al Yahar', 'name_ar' => 'اليهار'],
            ['city_id' => 152, 'name_en' => 'Al Sarooj', 'name_ar' => 'السروج'],
            ['city_id' => 152, 'name_en' => 'Al Falaj Hazza', 'name_ar' => 'الفلج هزاع'],
            ['city_id' => 152, 'name_en' => 'Al Ain Oasis', 'name_ar' => 'واحة العين'],
        ]);
    }
}
