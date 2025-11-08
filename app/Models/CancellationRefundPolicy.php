<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancellationRefundPolicy extends Model
{
    use HasFactory;

    protected $table = 'cancellation_refund_policies';

    protected $fillable = [
        'title_en',
        'title_ar',
        'slug',
        'content_en',
        'content_ar',
        'version',
        'effective_date',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
