<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'disliked_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dislikedUser()
    {
        return $this->belongsTo(User::class, 'disliked_user_id');
    }
}
