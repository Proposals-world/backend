<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeColor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    public function profile()
    {
        // Since user_profiles uses the same 'id' as users.id as its primary key,
        // we need to specify the local and foreign key explicitly.
        return $this->hasOne(UserProfile::class, 'id', 'id');
    }
}