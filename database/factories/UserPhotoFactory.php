<?php

namespace Database\Factories;

use App\Models\UserPhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPhotoFactory extends Factory
{
    protected $model = UserPhoto::class;

    protected static $photoIndex = 1;

    public function definition(): array
    {
        // Use image profile-1.jpg through profile-26.jpg
        $index = self::$photoIndex++;
        if (self::$photoIndex > 26) {
            self::$photoIndex = 1;
        }

        return [
            'photo_url' => "/frontend/img/icon/profile-{$index}.jpeg",
            'caption_en' => $this->faker->sentence(4),
            'caption_ar' => $this->faker->randomElement([
                'صورة شخصية',
                'صورة الملف الشخصي',
                'صورة المستخدم الرئيسية',
                'لقطة للمستخدم',
                'الملف الشخصي'
            ]),
            'is_verified' => true,
            'is_main' => true,
        ];
    }
}