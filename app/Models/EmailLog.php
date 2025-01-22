<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email_type',
        'subject_en',
        'subject_ar',
        'body_en',
        'body_ar',
        'sent_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}