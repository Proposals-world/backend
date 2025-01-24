<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

class Gender extends Enum
{
    protected static function values(): array
    {
        return [
            'male' => 'male',
            'female' => 'female',
        ];
    }

    protected static function labels(): array
    {
        return [
            'male' => 'Male',
            'female' => 'Female',
        ];
    }
}
