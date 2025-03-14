<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model {
    use HasFactory;

    protected $fillable = [
        'title_en', 'title_ar', 'slug', 'content_en', 'content_ar', 
        'image', 'views', 'status', 'seo_title_en', 'seo_title_ar', 
        'seo_description', 'seo_keywords'
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, 'blog_categories');
    }


    public function getImageUrlAttribute() {
        return config('app.url') . '/storage/' . $this->image;
    }
}