<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAgreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agreement_type',
        'agreement_version',
        'accepted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}