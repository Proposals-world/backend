<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

class MatchStatus extends Enum
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
            'accepted' => 'accepted',
            'rejected' => 'rejected',
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
            'accepted' => 'Accepted',
            'rejected' => 'Rejected',
        ];
    }
}
