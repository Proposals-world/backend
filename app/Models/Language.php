<?php

// app/Models/Language.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    // Define the table name (if not following the default plural naming convention)
    protected $table = 'languages';

    // Define the fillable columns for mass assignment
    protected $fillable = ['name_en', 'name_ar'];
    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class);
    }
    // app/Models/Language.php

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_preferred_languages', 'language_id', 'user_id');
    }
    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_language_id');
    }
}
