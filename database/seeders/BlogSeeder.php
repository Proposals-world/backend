<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run()
    {
        $blogs = [
            [
                'title_ar' => 'كيفية تقديم عرض زواج إسلامي',
                'title_en' => 'How to Make an Islamic Marriage Proposal',
                'slug' => Str::slug('How to Make an Islamic Marriage Proposal'),
                'content_ar' => 'في هذا المقال، سوف نناقش كيفية تقديم عرض زواج إسلامي محترم، مع مراعاة المبادئ الإسلامية وكيفية الحفاظ على الحشمة والاحترام في هذه العملية.',
                'content_en' => 'In this article, we will discuss how to make a respectful Islamic marriage proposal, taking into account Islamic principles and how to maintain modesty and respect in the process.',
                'image' => 'blogs/blog-1.jpeg',
                'views' => 0,
                'status' => 'published',
                'seo_title_ar' => 'كيفية تقديم عرض زواج إسلامي',
                'seo_title_en' => 'How to Make an Islamic Marriage Proposal',
                'seo_description' => 'دليل كامل حول كيفية تقديم عرض زواج إسلامي محترم. تعلم الخطوات والمبادئ التي يجب اتباعها.',
                'seo_keywords' => 'عرض زواج, إسلامي, الخطوات, الزواج',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_ar' => 'أهمية استشارة العائلة في الزواج الإسلامي',
                'title_en' => 'The Importance of Consulting Family in Islamic Marriage',
                'slug' => Str::slug('The Importance of Consulting Family in Islamic Marriage'),
                'content_ar' => 'في الزواج الإسلامي، يعتبر دور العائلة أمرًا بالغ الأهمية. هذا المقال يناقش كيفية استشارة العائلة وأهمية ذلك في ضمان نجاح العلاقة.',
                'content_en' => 'In Islamic marriage, the role of family is very important. This article discusses how to consult family members and the importance of doing so to ensure the success of the relationship.',
                'image' => 'blogs/blog-2.jpeg',
                'views' => 0,
                'status' => 'published',
                'seo_title_ar' => 'أهمية استشارة العائلة في الزواج الإسلامي',
                'seo_title_en' => 'The Importance of Consulting Family in Islamic Marriage',
                'seo_description' => 'اكتشف كيف أن استشارة العائلة تلعب دورًا أساسيًا في نجاح الزواج في الإسلام.',
                'seo_keywords' => 'استشارة العائلة, الزواج, الإسلام, النجاح',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_ar' => 'كيف تحترم العادات والتقاليد الإسلامية في الزواج',
                'title_en' => 'How to Respect Islamic Traditions in Marriage',
                'slug' => Str::slug('How to Respect Islamic Traditions in Marriage'),
                'content_ar' => 'هذا المقال يسلط الضوء على أهمية احترام العادات والتقاليد الإسلامية في الزواج وكيفية دمجها في حياتنا الزوجية.',
                'content_en' => 'This article highlights the importance of respecting Islamic traditions in marriage and how to incorporate them into married life.',
                'image' => 'blogs/blog-3.jpeg',
                'views' => 0,
                'status' => 'published',
                'seo_title_ar' => 'كيف تحترم العادات والتقاليد الإسلامية في الزواج',
                'seo_title_en' => 'How to Respect Islamic Traditions in Marriage',
                'seo_description' => 'تعلم كيفية احترام العادات والتقاليد الإسلامية في الزواج وجعلها جزءًا من حياتك الزوجية.',
                'seo_keywords' => 'عادات وتقاليد, الزواج, الإسلام, الاحترام',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_ar' => 'دور المرأة في الزواج الإسلامي',
                'title_en' => 'The Role of Women in Islamic Marriage',
                'slug' => Str::slug('The Role of Women in Islamic Marriage'),
                'content_ar' => 'المرأة في الزواج الإسلامي تعتبر شريكًا أساسيًا. في هذا المقال، سنتحدث عن الدور الذي تلعبه المرأة في الزواج وفقًا للإسلام.',
                'content_en' => 'The woman in Islamic marriage is considered a key partner. In this article, we will discuss the role of women in marriage according to Islam.',
                'image' => 'blogs/blog-4.jpeg',
                'views' => 0,
                'status' => 'published',
                'seo_title_ar' => 'دور المرأة في الزواج الإسلامي',
                'seo_title_en' => 'The Role of Women in Islamic Marriage',
                'seo_description' => 'اكتشف كيف أن المرأة تلعب دورًا هامًا في الزواج الإسلامي ودورها في بناء أسرة مستدامة.',
                'seo_keywords' => 'دور المرأة, الزواج, الإسلام, الشراكة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_ar' => 'أهمية النية في الزواج الإسلامي',
                'title_en' => 'The Importance of Intentions in Islamic Marriage',
                'slug' => Str::slug('The Importance of Intentions in Islamic Marriage'),
                'content_ar' => 'تعد النية الطيبة والمخلصة من أهم الجوانب في الزواج الإسلامي. تعرف على كيفية تحسين نواياك في بناء علاقة زوجية قائمة على الاحترام.',
                'content_en' => 'Having good and sincere intentions is one of the most important aspects of Islamic marriage. Learn how to improve your intentions in building a respectful marital relationship.',
                'image' => 'blogs/blog-1.jpeg',
                'views' => 0,
                'status' => 'published',
                'seo_title_ar' => 'أهمية النية في الزواج الإسلامي',
                'seo_title_en' => 'The Importance of Intentions in Islamic Marriage',
                'seo_description' => 'تعرف على أهمية النية الطيبة في الزواج الإسلامي وكيفية بناء علاقة قائمة على الاحترام والنوايا الحسنة.',
                'seo_keywords' => 'نية, الزواج, الإسلام, الاحترام',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_ar' => 'أفضل طرق للتواصل في العلاقات الزوجية الإسلامية',
                'title_en' => 'Best Communication Methods in Islamic Marital Relationships',
                'slug' => Str::slug('Best Communication Methods in Islamic Marital Relationships'),
                'content_ar' => 'في هذا المقال، نناقش أفضل الطرق للتواصل في العلاقات الزوجية الإسلامية وكيفية بناء علاقة قوية قائمة على الحوار والاحترام المتبادل.',
                'content_en' => 'In this article, we discuss the best communication methods in Islamic marital relationships and how to build a strong relationship based on dialogue and mutual respect.',
                'image' => 'blogs/blog-2.jpeg',
                'views' => 0,
                'status' => 'published',
                'seo_title_ar' => 'أفضل طرق للتواصل في العلاقات الزوجية الإسلامية',
                'seo_title_en' => 'Best Communication Methods in Islamic Marital Relationships',
                'seo_description' => 'اكتشف أفضل طرق التواصل في العلاقات الزوجية الإسلامية وكيفية تقوية العلاقة من خلال الحوار المفتوح.',
                'seo_keywords' => 'تواصل, الزواج, الإسلام, الحوار',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        $categories = Category::all(); // Assuming you already have categories in your DB.

        foreach ($blogs as $blogData) {
            // Insert the blog
            $blog = Blog::create($blogData);

            // Attach categories to the blog (example: attach 2 random categories)
            $blog->categories()->attach($categories->random(2)->pluck('id')->toArray());
        }
    }
}
