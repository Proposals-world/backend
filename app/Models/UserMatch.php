<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMatch extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'user_matches';

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
    public function removeMatch($matchId): bool
    {
        $match = UserMatch::find($matchId);

        if (!$match) {
            return false;
        }

        // ✅ Soft delete the match
        $match->delete(); // This should set deleted_at

        // ✅ Delete likes from both directions
        Like::where('user_id', $match->user1_id)
            ->where('liked_user_id', $match->user2_id)
            ->delete();

        Like::where('user_id', $match->user2_id)
            ->where('liked_user_id', $match->user1_id)
            ->delete();

        return true;
    }
}
