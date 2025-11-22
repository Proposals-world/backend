<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    // please check the cities before being used
    public function run()
    {
        DB::table('cities')->insert([
            //jordan
            ['name_en' => 'Amman', 'name_ar' => 'عمان', 'country_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Zarqa', 'name_ar' => 'الزرقاء', 'country_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Irbid', 'name_ar' => 'إربد', 'country_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Aqaba', 'name_ar' => 'العقبة', 'country_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Mafraq', 'name_ar' => 'المفرق', 'country_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Jerash', 'name_ar' => 'جرش', 'country_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Madaba', 'name_ar' => 'مادبا', 'country_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Karak', 'name_ar' => 'الكرك', 'country_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tafila', 'name_ar' => 'الطفيلة', 'country_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Balqa', 'name_ar' => 'البلقاء', 'country_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Ajloun', 'name_ar' => 'عجلون', 'country_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Maan', 'name_ar' => 'معان', 'country_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            //Egypt
            // القاهرة - المناطق الرئيسية: الزمالك، المعادي، مدينة نصر، مصر الجديدة، وسط البلد، التجمع الخامس
            ['name_en' => 'Cairo', 'name_ar' => 'القاهرة', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // الإسكندرية - المناطق الرئيسية: المنتزه، سموحة، سيدي جابر، رشدي، العجمي، وسط البلد
            ['name_en' => 'Alexandria', 'name_ar' => 'الإسكندرية', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // الجيزة - المناطق الرئيسية: الدقي، المهندسين، إمبابة، 6 أكتوبر، الشيخ زايد، الحدائق
            ['name_en' => 'Giza', 'name_ar' => 'الجيزة', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // بورسعيد - المناطق الرئيسية: الشرق، المناخ، العرب، الضواحي، بورسعيد الجديدة
            ['name_en' => 'Port Said', 'name_ar' => 'بورسعيد', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // السويس - المناطق الرئيسية: السويس، الأربعين، فيصل، الجناين
            ['name_en' => 'Suez', 'name_ar' => 'السويس', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // الأقصر - المناطق الرئيسية: الكرنك، شرق النيل، غرب النيل، العوامية
            ['name_en' => 'Luxor', 'name_ar' => 'الأقصر', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // أسوان - المناطق الرئيسية: وسط أسوان، جزيرة الفنتين، غرب سهيل، كوم أمبو
            ['name_en' => 'Aswan', 'name_ar' => 'أسوان', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // الإسماعيلية - المناطق الرئيسية: وسط الإسماعيلية، حي الشيخ زايد، حي الفيروز
            ['name_en' => 'Ismailia', 'name_ar' => 'الإسماعيلية', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // دمياط - المناطق الرئيسية: وسط دمياط، رأس البر، دمياط الجديدة
            ['name_en' => 'Damietta', 'name_ar' => 'دمياط', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // المنصورة - المناطق الرئيسية: وسط المنصورة، الجمرك، ميت خميس، طلخا
            ['name_en' => 'Mansoura', 'name_ar' => 'المنصورة', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // الزقازيق - المناطق الرئيسية: وسط الزقازيق، حي الأحرار، حي الزهور
            ['name_en' => 'Zagazig', 'name_ar' => 'الزقازيق', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // طنطا - المناطق الرئيسية: وسط طنطا، سيجر، المحطة، المعتصم
            ['name_en' => 'Tanta', 'name_ar' => 'طنطا', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // الفيوم - المناطق الرئيسية: وسط الفيوم، سنورس، طامية، إطسا
            ['name_en' => 'Faiyum', 'name_ar' => 'الفيوم', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // بنها - المناطق الرئيسية: وسط بنها، كفر الجزار، حي الزهور
            ['name_en' => 'Banha', 'name_ar' => 'بنها', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // المنيا - المناطق الرئيسية: وسط المنيا، ملوي، سمالوط، بني مزار
            ['name_en' => 'Minya', 'name_ar' => 'المنيا', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // أسيوط - المناطق الرئيسية: وسط أسيوط، الفتح، منفلوط، ديروط
            ['name_en' => 'Assiut', 'name_ar' => 'أسيوط', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // سوهاج - المناطق الرئيسية: وسط سوهاج، جرجا، طهطا، أخميم
            ['name_en' => 'Sohag', 'name_ar' => 'سوهاج', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // قنا - المناطق الرئيسية: وسط قنا، نجع حمادي، قوص، نقادة
            ['name_en' => 'Qena', 'name_ar' => 'قنا', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // كفر الشيخ - المناطق الرئيسية: وسط كفر الشيخ، دسوق، فوه، مطوبس
            ['name_en' => 'Kafr El Sheikh', 'name_ar' => 'كفر الشيخ', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // بني سويف - المناطق الرئيسية: وسط بني سويف، الواسطى، ناصر، ببا
            ['name_en' => 'Beni Suef', 'name_ar' => 'بني سويف', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // دمنهور - المناطق الرئيسية: وسط دمنهور، كفر الدوار، إيتاي البارود، أبو حمص
            ['name_en' => 'Damanhur', 'name_ar' => 'دمنهور', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // شبين الكوم - المناطق الرئيسية: وسط شبين الكوم، تلا، قويسنا، بركة السبع
            ['name_en' => 'Shibin El Kom', 'name_ar' => 'شبين الكوم', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // مرسى مطروح - المناطق الرئيسية: وسط مرسى مطروح، العلمين، الضبعة، سيوة
            ['name_en' => 'Marsa Matruh', 'name_ar' => 'مرسى مطروح', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // العريش - المناطق الرئيسية: وسط العريش، الشيخ زويد، رفح
            ['name_en' => 'Arish', 'name_ar' => 'العريش', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // شرم الشيخ - المناطق الرئيسية: خليج نعمة، رأس نصراني، شرم المايا
            ['name_en' => 'Sharm El Sheikh', 'name_ar' => 'شرم الشيخ', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // الغردقة - المناطق الرئيسية: السقالة، الدهار، الكوثر، مكادي
            ['name_en' => 'Hurghada', 'name_ar' => 'الغردقة', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // الخارجة - المناطق الرئيسية: وسط الخارجة، الداخلة، باريس
            ['name_en' => 'Kharga', 'name_ar' => 'الخارجة', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // المحلة الكبرى - المناطق الرئيسية: وسط المحلة، سمنود، زفتى
            ['name_en' => 'El Mahalla El Kubra', 'name_ar' => 'المحلة الكبرى', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // مدينة 6 أكتوبر - المناطق الرئيسية: الحي المتميز، حي الأشجار، دريم لاند
            ['name_en' => '6th of October City', 'name_ar' => 'مدينة 6 أكتوبر', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // حلوان - المناطق الرئيسية: وسط حلوان، 15 مايو، المساكن
            ['name_en' => 'Helwan', 'name_ar' => 'حلوان', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // رشيد - المناطق الرئيسية: وسط رشيد، إدفينا، مطوبس
            ['name_en' => 'Rashid', 'name_ar' => 'رشيد', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // كفر الدوار - المناطق الرئيسية: وسط كفر الدوار، أبو قير، المندورة
            ['name_en' => 'Kafr El Dawar', 'name_ar' => 'كفر الدوار', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // العاصمة الإدارية - المناطق الرئيسية: الحي الحكومي، الحي السكني R7، الحي المالي
            ['name_en' => 'New Administrative Capital', 'name_ar' => 'العاصمة الإدارية', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // دسوق - المناطق الرئيسية: وسط دسوق، كفر مجر، بيلا
            ['name_en' => 'Desouk', 'name_ar' => 'دسوق', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // إدفو - المناطق الرئيسية: وسط إدفو، الكلاحين، العدوة
            ['name_en' => 'Edfu', 'name_ar' => 'إدفو', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // أبو سمبل - المناطق الرئيسية: وسط أبو سمبل، توشكى
            ['name_en' => 'Abu Simbel', 'name_ar' => 'أبو سمبل', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // أسنا - المناطق الرئيسية: وسط أسنا، الكرنك، الكيمان
            ['name_en' => 'Esna', 'name_ar' => 'أسنا', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // زفتى - المناطق الرئيسية: وسط زفتى، كفر زفتى، الصناعية
            ['name_en' => 'Zefta', 'name_ar' => 'زفتى', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // ميت غمر - المناطق الرئيسية: وسط ميت غمر، دكرنس، أجا
            ['name_en' => 'Mit Ghamr', 'name_ar' => 'ميت غمر', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // السنبلاوين - المناطق الرئيسية: وسط السنبلاوين، منية النصر، تمي الأمديد
            ['name_en' => 'Senbellawein', 'name_ar' => 'السنبلاوين', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // نجع حمادي - المناطق الرئيسية: وسط نجع حمادي، دشنا، الوقف
            ['name_en' => 'Nag Hammadi', 'name_ar' => 'نجع حمادي', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // أخميم - المناطق الرئيسية: وسط أخميم، ساقلته، البلينا
            ['name_en' => 'Akhmim', 'name_ar' => 'أخميم', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // طما - المناطق الرئيسية: وسط طما، المراغة، جهينة
            ['name_en' => 'Tama', 'name_ar' => 'طما', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // جرجا - المناطق الرئيسية: وسط جرجا، البلينا، سوهاج
            ['name_en' => 'Girga', 'name_ar' => 'جرجا', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // ديروط - المناطق الرئيسية: وسط ديروط، القوصية، منفلوط
            ['name_en' => 'Dayrout', 'name_ar' => 'ديروط', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // Lebanon
            ['name_en' => 'Beirut', 'name_ar' => 'بيروت', 'country_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tripoli', 'name_ar' => 'طرابلس', 'country_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sidon', 'name_ar' => 'صيدا', 'country_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tyre', 'name_ar' => 'صور', 'country_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Zahle', 'name_ar' => 'زحلة', 'country_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Byblos', 'name_ar' => 'جبيل', 'country_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Baabda', 'name_ar' => 'بعبدا', 'country_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Jounieh', 'name_ar' => 'جونيه', 'country_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Aley', 'name_ar' => 'عاليه', 'country_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Baalbek', 'name_ar' => 'بعلبك', 'country_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Hermel', 'name_ar' => 'هرمل', 'country_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Bint Jbeil', 'name_ar' => 'بنت جبيل', 'country_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Nabatieh', 'name_ar' => 'النبطية', 'country_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            //syria
            ['name_en' => 'Damascus', 'name_ar' => 'دمشق', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Aleppo', 'name_ar' => 'حلب', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Homs', 'name_ar' => 'حمص', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Latakia', 'name_ar' => 'اللاذقية', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tartus', 'name_ar' => 'طرطوس', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Deir ez-Zor', 'name_ar' => 'دير الزور', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Raqqa', 'name_ar' => 'الرقة', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Idlib', 'name_ar' => 'إدلب', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Daraa', 'name_ar' => 'درعا', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al-Hasakah', 'name_ar' => 'الحسكة', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Rural Damascus', 'name_ar' => 'ريف دمشق', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Qamishli', 'name_ar' => 'القامشلي', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Hama', 'name_ar' => 'حماة', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'As-Suwayda', 'name_ar' => 'السويداء', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Quneitra', 'name_ar' => 'القنيطرة', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            //Palestine
            ['name_en' => 'Ramallah', 'name_ar' => 'رام الله', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Nablus', 'name_ar' => 'نابلس', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Hebron', 'name_ar' => 'الخليل', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Bethlehem', 'name_ar' => 'بيت لحم', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Jenin', 'name_ar' => 'جنين', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tulkarem', 'name_ar' => 'طولكرم', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Qalqilya', 'name_ar' => 'قلقيلية', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Gaza', 'name_ar' => 'غزة', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Khan Yunis', 'name_ar' => 'خان يونس', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Rafah', 'name_ar' => 'رفح', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Jericho', 'name_ar' => 'أريحا', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Salfit', 'name_ar' => 'سلفيت', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Ariel', 'name_ar' => 'أريئيل', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tubas', 'name_ar' => 'طوباس', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Bani Naim', 'name_ar' => 'بني نعيم', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'East Jerusalem', 'name_ar' => 'القدس الشرقية', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Deir al-Balah', 'name_ar' => 'دير البلح', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'North Gaza', 'name_ar' => 'شمال غزة', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],

            // Iraq
            ['name_en' => 'Baghdad', 'name_ar' => 'بغداد', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Basra', 'name_ar' => 'البصرة', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Mosul', 'name_ar' => 'الموصل', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Kirkuk', 'name_ar' => 'كركوك', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Erbil', 'name_ar' => 'أربيل', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Najaf', 'name_ar' => 'النجف', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Karbala', 'name_ar' => 'كربلاء', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sulaymaniyah', 'name_ar' => 'السليمانية', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Dohuk', 'name_ar' => 'دهوك', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Samawah', 'name_ar' => 'السماوة', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Diwaniya', 'name_ar' => 'الديوانية', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Nasiriyah', 'name_ar' => 'الناصرية', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Amarah', 'name_ar' => 'العمارة', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Ramadi', 'name_ar' => 'الرمادي', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tikrit', 'name_ar' => 'تكريت', 'country_id' => 6,  'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Baqubah', 'name_ar' => 'بعقوبة', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Kut', 'name_ar' => 'الكوت', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Halabja', 'name_ar' => 'حلبجة', 'country_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            //Saudi Arabia
            ['name_en' => 'Riyadh', 'name_ar' => 'الرياض', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Jeddah', 'name_ar' => 'جدة', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Mecca', 'name_ar' => 'مكة', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Medina', 'name_ar' => 'المدينة المنورة', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Dammam', 'name_ar' => 'الدمام', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Khobar', 'name_ar' => 'الخبر', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Taif', 'name_ar' => 'الطائف', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Abha', 'name_ar' => 'أبها', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Buraidah', 'name_ar' => 'بريدة', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Khamis Mushait', 'name_ar' => 'خميس مشيط', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Najran', 'name_ar' => 'نجران', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Hail', 'name_ar' => 'حائل', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Jubail', 'name_ar' => 'الجبيل', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Yanbu', 'name_ar' => 'ينبع', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Ahsa', 'name_ar' => 'الأحساء', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Qatif', 'name_ar' => 'القطيف', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Arar', 'name_ar' => 'عرعر', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Kharj', 'name_ar' => 'الخرج', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tabuk', 'name_ar' => 'تبوك', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Jazan', 'name_ar' => 'جازان', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Baha', 'name_ar' => 'الباحة', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Dhahran', 'name_ar' => 'الظهران', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Hafar Al Batin', 'name_ar' => 'حفر الباطن', 'country_id' => 7, 'created_at' => now(), 'updated_at' => now()],

            //UAE
            ['name_en' => 'Abu Dhabi', 'name_ar' => 'أبو ظبي', 'country_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Dubai', 'name_ar' => 'دبي', 'country_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sharjah', 'name_ar' => 'الشارقة', 'country_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Ajman', 'name_ar' => 'عجمان', 'country_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Umm Al-Quwain', 'name_ar' => 'أم القيوين', 'country_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Fujairah', 'name_ar' => 'الفجيرة', 'country_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Ras Al Khaimah', 'name_ar' => 'رأس الخيمة', 'country_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Ain', 'name_ar' => 'العين', 'country_id' => 8, 'created_at' => now(), 'updated_at' => now()],

            // reached in citylocation table seeder
            //Kuwait
            ['name_en' => 'Kuwait City', 'name_ar' => 'مدينة الكويت', 'country_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Hawalli', 'name_ar' => 'حولي', 'country_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Salmiya', 'name_ar' => 'السالمية', 'country_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Mubarak Al Kabeer', 'name_ar' => 'مبارك الكبير', 'country_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Jahra', 'name_ar' => 'الجهراء', 'country_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Farwaniyah', 'name_ar' => 'الفروانية', 'country_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Ahmadi', 'name_ar' => 'الأحمدي', 'country_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Fahaheel', 'name_ar' => 'الفحيحيل', 'country_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Riqqa', 'name_ar' => 'الرقة', 'country_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sabah Al Salem', 'name_ar' => 'صباح السالم', 'country_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Aqila', 'name_ar' => 'العقيلة', 'country_id' => 9, 'created_at' => now(), 'updated_at' => now()],

            // Qatar
            ['name_en' => 'Doha', 'name_ar' => 'الدوحة', 'country_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Rayyan', 'name_ar' => 'الريان', 'country_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Khor', 'name_ar' => 'الخور', 'country_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Wakrah', 'name_ar' => 'الوكرة', 'country_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Daayen', 'name_ar' => 'الدعين', 'country_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Umm Salal', 'name_ar' => 'أم صلال', 'country_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Mesaieed', 'name_ar' => 'مسعيد', 'country_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Shamal', 'name_ar' => 'الشمال', 'country_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Shahaniya', 'name_ar' => 'الشحانية', 'country_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            // reached -----///------
            // Bahrain
            ['name_en' => 'Manama', 'name_ar' => 'المنامة', 'country_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Muharraq', 'name_ar' => 'المحرق', 'country_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Riffa', 'name_ar' => 'الرفاع', 'country_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sitra', 'name_ar' => 'سترة', 'country_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Isa Town', 'name_ar' => 'مدينة عيسى', 'country_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => "A'ali", 'name_ar' => 'عالي', 'country_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Jidhafs', 'name_ar' => 'جدحفص', 'country_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Hamad Town', 'name_ar' => 'مدينة حمد', 'country_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Budaiya', 'name_ar' => 'البديع', 'country_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Hidd', 'name_ar' => 'الحد', 'country_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Dair Kulayb', 'name_ar' => 'دار كليب', 'country_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            // Oman
            ['name_en' => 'Muscat', 'name_ar' => 'مسقط', 'country_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Salalah', 'name_ar' => 'صلالة', 'country_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sohar', 'name_ar' => 'صحار', 'country_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Nizwa', 'name_ar' => 'نِزوى', 'country_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Buraimi', 'name_ar' => 'البريمي', 'country_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sur', 'name_ar' => 'صور', 'country_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Ibra', 'name_ar' => 'إبراء', 'country_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Rustaq', 'name_ar' => 'الرستاق', 'country_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Khasab', 'name_ar' => 'خصب', 'country_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Ibri', 'name_ar' => 'إبري', 'country_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Haima', 'name_ar' => 'هيماء', 'country_id' => 12, 'created_at' => now(), 'updated_at' => now()],

            // Yemen
            ['name_en' => 'Sana\'a', 'name_ar' => 'صنعاء', 'country_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Aden', 'name_ar' => 'عدن', 'country_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Taiz', 'name_ar' => 'تعز', 'country_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Hodeidah', 'name_ar' => 'الحديدة', 'country_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Ibb', 'name_ar' => 'إب', 'country_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Mukalla', 'name_ar' => 'المكلا', 'country_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Dhamar', 'name_ar' => 'ذمار', 'country_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Marib', 'name_ar' => 'مأرب', 'country_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sa\'da', 'name_ar' => 'صعدة', 'country_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Hajjah', 'name_ar' => 'حجة', 'country_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Dhalie', 'name_ar' => 'الضالع', 'country_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Seiyun', 'name_ar' => 'سيئون', 'country_id' => 13, 'created_at' => now(), 'updated_at' => now()],

            // Sudan
            ['name_en' => 'Khartoum', 'name_ar' => 'الخرطوم', 'country_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Omdurman', 'name_ar' => 'أم درمان', 'country_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Nyala', 'name_ar' => 'نيالا', 'country_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Port Sudan', 'name_ar' => 'بورتسودان', 'country_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'El Fasher', 'name_ar' => 'الفاشر', 'country_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Kosti', 'name_ar' => 'كوستي', 'country_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'El Obeid', 'name_ar' => 'الأبيض', 'country_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Wad Madani', 'name_ar' => 'ود مدني', 'country_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Atbara', 'name_ar' => 'عطبرة', 'country_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sennar', 'name_ar' => 'سنار', 'country_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Gedaref', 'name_ar' => 'القضارف', 'country_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Kassala', 'name_ar' => 'كسلا', 'country_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Dongola', 'name_ar' => 'دنقلا', 'country_id' => 14, 'created_at' => now(), 'updated_at' => now()],


            // Libya
            ['name_en' => 'Tripoli', 'name_ar' => 'طرابلس', 'country_id' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Benghazi', 'name_ar' => 'بنغازي', 'country_id' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Misrata', 'name_ar' => 'مصراتة', 'country_id' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Zawiya', 'name_ar' => 'الزاوية', 'country_id' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Al Bayda', 'name_ar' => 'البيضاء', 'country_id' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sabratha', 'name_ar' => 'صبراته', 'country_id' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Khoms', 'name_ar' => 'الخمس', 'country_id' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Ghat', 'name_ar' => 'غات', 'country_id' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sebha', 'name_ar' => 'سبها', 'country_id' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tobruk', 'name_ar' => 'طبرق', 'country_id' => 15, 'created_at' => now(), 'updated_at' => now()],

            // Tunisia
            ['name_en' => 'Tunis', 'name_ar' => 'تونس', 'country_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sfax', 'name_ar' => 'صفاقس', 'country_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sousse', 'name_ar' => 'سوسة', 'country_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Kairouan', 'name_ar' => 'القيروان', 'country_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Gabes', 'name_ar' => 'قابس', 'country_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Bizerte', 'name_ar' => 'بنزرت', 'country_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Medenine', 'name_ar' => 'مدنين', 'country_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tataouine', 'name_ar' => 'تطاوين', 'country_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Monastir', 'name_ar' => 'المنستير', 'country_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Kasserine', 'name_ar' => 'القصرين', 'country_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Ariana', 'name_ar' => 'أريانة', 'country_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Nabeul', 'name_ar' => 'نابل', 'country_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Gafsa', 'name_ar' => 'قفصة', 'country_id' => 16, 'created_at' => now(), 'updated_at' => now()],


            // Algeria
            ['name_en' => 'Algiers', 'name_ar' => 'الجزائر', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Oran', 'name_ar' => 'وهران', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Constantine', 'name_ar' => 'قسنطينة', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Annaba', 'name_ar' => 'عنابة', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Blida', 'name_ar' => 'البليدة', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Batna', 'name_ar' => 'باتنة', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tlemcen', 'name_ar' => 'تلمسان', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Setif', 'name_ar' => 'سطيف', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Chlef', 'name_ar' => 'الشلف', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Saida', 'name_ar' => 'سعيدة', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Jijel', 'name_ar' => 'جيجل', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Bejaia', 'name_ar' => 'بجاية', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Mascara', 'name_ar' => 'معسكر', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tiaret', 'name_ar' => 'تيارت', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'El Oued', 'name_ar' => 'وادي سوف', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Skikda', 'name_ar' => 'سكيكدة', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Ouargla', 'name_ar' => 'ورقلة', 'country_id' => 17, 'created_at' => now(), 'updated_at' => now()],

            // Morocco
            ['name_en' => 'Rabat', 'name_ar' => 'الرباط', 'country_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Casablanca', 'name_ar' => 'الدار البيضاء', 'country_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Marrakech', 'name_ar' => 'مراكش', 'country_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Fes', 'name_ar' => 'فاس', 'country_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tangier', 'name_ar' => 'طنجة', 'country_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Agadir', 'name_ar' => 'أكادير', 'country_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Meknes', 'name_ar' => 'مكناس', 'country_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Essaouira', 'name_ar' => 'الصويرة', 'country_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Oujda', 'name_ar' => 'وجدة', 'country_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tetouan', 'name_ar' => 'تطوان', 'country_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sale', 'name_ar' => 'سلا', 'country_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Kenitra', 'name_ar' => 'القنيطرة', 'country_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Laayoune', 'name_ar' => 'العيون', 'country_id' => 18, 'created_at' => now(), 'updated_at' => now()],


            // Mauritania
            ['name_en' => 'Nouakchott', 'name_ar' => 'نواكشوط', 'country_id' => 19, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Nouadhibou', 'name_ar' => 'نواذيبو', 'country_id' => 19, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Kiffa', 'name_ar' => 'كيفة', 'country_id' => 19, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Atar', 'name_ar' => 'آتر', 'country_id' => 19, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Zouerate', 'name_ar' => 'زويرات', 'country_id' => 19, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tidjikja', 'name_ar' => 'تيديكجا', 'country_id' => 19, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Rosso', 'name_ar' => 'روسو', 'country_id' => 19, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Selibaby', 'name_ar' => 'سيلبابي', 'country_id' => 19, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Bogue', 'name_ar' => 'بوكي', 'country_id' => 19, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Kaedi', 'name_ar' => 'كيهيدي', 'country_id' => 19, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Aleg', 'name_ar' => 'ألاك', 'country_id' => 19, 'created_at' => now(), 'updated_at' => now()],

            //Somalia
            ['name_en' => 'Mogadishu', 'name_ar' => 'مقديشو', 'country_id' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Hargeisa', 'name_ar' => 'هرجيسا', 'country_id' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Bosaso', 'name_ar' => 'بوساسو', 'country_id' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Kismayo', 'name_ar' => 'كيسمايو', 'country_id' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Baidoa', 'name_ar' => 'بايدوا', 'country_id' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Galkayo', 'name_ar' => 'غالكيو', 'country_id' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Jowhar', 'name_ar' => 'جوهار', 'country_id' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Burao', 'name_ar' => 'بوراو', 'country_id' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Berbera', 'name_ar' => 'بربرة', 'country_id' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['country_id' => 20, 'created_at' => now(), 'name_ar' => 'مركة', 'name_en' => 'Merca', 'updated_at' => now()],
            ['name_en' => 'Beledweyne', 'name_ar' => 'بلدوين', 'country_id' => 20, 'created_at' => now(), 'updated_at' => now()],


            // Djibouti
            ['name_en' => 'Djibouti City', 'name_ar' => 'مدينة جيبوتي', 'country_id' => 21, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Ali Sabieh', 'name_ar' => 'علي صبيح', 'country_id' => 21, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tadjoura', 'name_ar' => 'تاجورة', 'country_id' => 21, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Obock', 'name_ar' => 'عقبة', 'country_id' => 21, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Dikhil', 'name_ar' => 'ديخل', 'country_id' => 21, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Arta', 'name_ar' => 'أرتا', 'country_id' => 21, 'created_at' => now(), 'updated_at' => now()],
            // Comoros
            ['name_en' => 'Moroni', 'name_ar' => 'موروني', 'country_id' => 22, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Mutsamudu', 'name_ar' => 'موشامودو', 'country_id' => 22, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Fomboni', 'name_ar' => 'فومبوني', 'country_id' => 22, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Domoni', 'name_ar' => 'دوموني', 'country_id' => 22, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sima', 'name_ar' => 'سيما', 'country_id' => 22, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Mitsamiouli', 'name_ar' => 'ميتساميولي', 'country_id' => 22, 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
e
