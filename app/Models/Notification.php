<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'notifiable_type',
        'notifiable_id',
        'notification_type',
        'content_en',
        'content_ar',
        'is_read',
        // if you added them in migration:
        // 'title_en', 'title_ar', 'action_url', 'data',
    ];

    public function notifiable()
    {
        return $this->morphTo();
    }
}
