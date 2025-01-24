<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

class AccountStatus extends Enum
{
    protected static function values(): array
    {
        return [
            'active' => 1,
            'not_active' => 2,
            'engaged' => 3,
            'suspended' => 4,
        ];
    }

    protected static function labels(): array
    {
        return [
            'active' => 'Active',
            'not_active' => 'Not Active',
            'engaged' => 'Engaged',
            'suspended' => 'Suspended',
        ];
    }
}
