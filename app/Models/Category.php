<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name_en', 'name_ar','slug'];

    public function blogs() {
        return $this->belongsToMany(Blog::class, 'blog_categories');
    }
}