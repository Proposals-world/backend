<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_code',
        'content_en',
        'content_ar',
        'seo_id',
    ];

    public function seoSetting()
    {
        return $this->belongsTo(SeoSetting::class, 'seo_id');
    }
}