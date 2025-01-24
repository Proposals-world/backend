<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

class ReportStatus extends Enum
{
    /**
     * Define the values of the enum.
     *
     * @return array
     */
    protected static function values(): array
    {
        return [
            'pending' => 'pending',
            'reviewed' => 'reviewed',
            'action_taken' => 'action_taken',
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
            'pending' => 'Pending',
            'reviewed' => 'Reviewed',
            'action_taken' => 'Action Taken',
        ];
    }
}
