<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHobby extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hobbies_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hobby()
    {
        return $this->belongsTo(Hobby::class, 'hobbies_id');
    }
}