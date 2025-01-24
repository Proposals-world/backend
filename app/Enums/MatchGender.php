<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

class MatchGender extends Enum
{
    /**
     * Define the values of the enum.
     *
     * @return array
     */
    protected static function values(): array
    {
        return [
            'male_female' => 'male_female',
            'female_male' => 'female_male',
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
            'male_female' => 'Male & Female',
            'female_male' => 'Female & Male',
        ];
    }
}
