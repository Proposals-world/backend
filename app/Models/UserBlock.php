<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBlock extends Model
{
    use HasFactory;

    protected $primaryKey = 'block_id';

    protected $fillable = [
        'blocker_id',
        'blocked_id',
        'block_start_time',
        'block_end_time',
        'reason_en',
        'reason_ar',
    ];

    // Relationships
    public function blocker()
    {
        return $this->belongsTo(User::class, 'blocker_id');
    }

    public function blocked()
    {
        return $this->belongsTo(User::class, 'blocked_id');
    }
}
