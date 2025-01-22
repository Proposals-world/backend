<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSmokingToolPivot extends Model
{
    use HasFactory;

    protected $table = 'user_smoking_tool_pivot';

    protected $fillable = [
        'tool_id',
        'smoking_status_id',
    ];

    public function smokingTool()
    {
        return $this->belongsTo(SmokingTool::class, 'tool_id');
    }

    public function smokingStatus()
    {
        return $this->belongsTo(SmokingStatus::class, 'smoking_status_id');
    }
}