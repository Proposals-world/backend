<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

class SubscriptionStatus extends Enum
{
    /**
     * Define the values of the enum.
     *
     * @return array
     */
    protected static function values(): array
    {
        return [
            'active' => 'active',
            'expired' => 'expired',
            'canceled' => 'canceled',
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
            'active' => 'Active',
            'expired' => 'Expired',
            'canceled' => 'Canceled',
        ];
    }
}
