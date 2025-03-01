<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model {
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'content', 'image', 'views', 
        'status', 'seo_title', 'seo_description', 'seo_keywords'
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, 'blog_categories');
    }
}