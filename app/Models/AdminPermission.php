<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $table = 'admin_permissions';

    protected $fillable = [
        'user_id',
        'can_create',
        'can_edit',
        'can_delete',
        'can_view',
        'can_manage_roles',
    ];

    /**
     * Relation to the User model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
