<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAgreement extends Model
{
    use HasFactory;

    protected $primaryKey = 'agreement_id';

    protected $fillable = [
        'user_id',
        'agreement_type',
        'agreement_version',
        'agreed_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The user that accepted the agreement.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
