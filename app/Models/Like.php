<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'liked_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likedUser()
    {
        return $this->belongsTo(User::class, 'liked_user_id');
    }

    public static function isMatch($userId1, $userId2)
    {
        return self::where(function ($query) use ($userId1, $userId2) {
            $query->where('user_id', $userId1)
                ->where('liked_user_id', $userId2);
        })
            ->whereExists(function ($query) use ($userId1, $userId2) {
                $query->select('id')
                    ->from('likes')
                    ->where('user_id', $userId2)
                    ->where('liked_user_id', $userId1);
            })
            ->exists();
    }
}
