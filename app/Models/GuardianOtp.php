<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuardianOtp extends Model
{
    protected $fillable = ['user_id', 'phone', 'code', 'expires_at', 'verified'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
