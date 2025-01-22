<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    protected $primaryKey = 'match_id';

    protected $fillable = [
        'user1_id',
        'user2_id',
        'match_gender',
        'match_percentage',
        'match_status',
        'contact_exchanged',
    ];

    // Relationships
    public function user1()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    public function userFeedbacks()
    {
        return $this->hasMany(UserFeedback::class, 'match_id');
    }
}
