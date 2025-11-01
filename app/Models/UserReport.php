<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporter_id',
        'reported_id',
        'reason_en',
        'reason_ar',
        'other_reason_en',
        'other_reason_ar',
        'status',
        'report_count',
        'reported_photo',
    ];
    const REASONS_EN = [
        'Inappropriate Photos',
        'Harassment',
        'Disrespectful Behavior',
        'Asking for Haram (Forbidden)',
        'Fake Profile',
        'Spam or Advertising',
        'Offensive Language',
        'Not Serious About Marriage',
        'Misleading Information',
        'Other',
    ];

    const REASONS_AR = [
        'صور غير لائقة',
        'تحرش',
        'سلوك غير محترم',
        'طلب أمور محرمة',
        'ملف شخصي مزيف',
        'رسائل مزعجة أو إعلانات',
        'ألفاظ مسيئة',
        'عدم الجدية في الزواج',
        'معلومات مضللة',
        'أخرى',
    ];
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function reported()
    {
        return $this->belongsTo(User::class, 'reported_id');
    }
}
