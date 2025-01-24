<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

class EmploymentStatus extends Enum
{
    /**
     * Define the values of the enum.
     *
     * @return array
     */
    protected static function values(): array
    {
        return [
            'no' => 'no',
            'yes' => 'yes',
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
            'no' => 'No',
            'yes' => 'Yes',
        ];
    }
}
