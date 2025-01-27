<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

class ZodiacSign extends Enum
{
    /**
     * Define the values of the enum.
     *
     * @return array
     */
    protected static function values(): array
    {
        return [
            'aries' => 'aries',
            'taurus' => 'taurus',
            'gemini' => 'gemini',
            'cancer' => 'cancer',
            'leo' => 'leo',
            'virgo' => 'virgo',
            'libra' => 'libra',
            'scorpio' => 'scorpio',
            'sagittarius' => 'sagittarius',
            'capricorn' => 'capricorn',
            'aquarius' => 'aquarius',
            'pisces' => 'pisces',
        ];
    }

    /**
     * Define the labels for the enum values.
     *
     * @return array
     */
    protected static function labels(): array
    {
        return [
            'aries' => 'Aries',
            'taurus' => 'Taurus',
            'gemini' => 'Gemini',
            'cancer' => 'Cancer',
            'leo' => 'Leo',
            'virgo' => 'Virgo',
            'libra' => 'Libra',
            'scorpio' => 'Scorpio',
            'sagittarius' => 'Sagittarius',
            'capricorn' => 'Capricorn',
            'aquarius' => 'Aquarius',
            'pisces' => 'Pisces',
        ];
    }
}
