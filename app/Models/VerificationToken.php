<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token',
        'token_type',
        'expires_at',
        'is_used',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}