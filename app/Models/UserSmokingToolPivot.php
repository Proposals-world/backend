<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSmokingToolPivot extends Model
{
    use HasFactory;

    protected $table = 'user_smoking_tool_pivot';

    protected $fillable = [
        'user_profile_id', 
        'tool_id',
    ];

    public function smokingTool()
    {
        return $this->belongsTo(SmokingTool::class, 'tool_id');
    }

        public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'user_profile_id');
    }
}