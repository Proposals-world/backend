<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMatch extends Model
{
    use HasFactory;

    protected $table = 'matches';

    protected $fillable = [
        'user1_id',
        'user2_id',
        'match_gender',
        'match_percentage',
        'match_status',
        'contact_exchanged',
    ];

    public function user1()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    public function feedback()
    {
        return $this->hasOne(UserFeedback::class, 'match_id');
    }
}