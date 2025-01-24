<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

class SmokingStatus extends Enum
{
    /**
     * Define the values of the enum.
     *
     * @return array
     */
    protected static function values(): array
    {
        return [
            'smoker' => 'smoker',
            'non_smoker' => 'non_smoker',
            'quit' => 'quit',
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
            'smoker' => 'Smoker',
            'non_smoker' => 'Non-Smoker',
            'quit' => 'Quit',
        ];
    }
}
