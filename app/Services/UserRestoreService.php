<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRestoreService
{
    protected $messages;
    protected string $lang;

    public function __construct($lang = 'en')
    {
        $this->messages = [
            'en' => [
                'not_found'       => 'User not found.',
                'not_deleted'     => 'User account is not deleted.',
                'restored'        => 'The account has been successfully restored.',
                'invalid_pass'    => 'Invalid password.',
            ],
            'ar' => [
                'not_found'       => 'المستخدم غير موجود.',
                'not_deleted'     => 'الحساب لم يتم حذفه.',
                'restored'        => 'تم استعادة الحساب بنجاح.',
                'invalid_pass'    => 'كلمة المرور غير صحيحة.',
            ],
        ];

        $this->lang = $lang;
    }

    public function restoreUser(string $email, string $password): array
    {
        // Find user including soft-deleted records
        $user = User::withTrashed()->where('email', $email)->first();

        if (!$user) {
            return [
                'success' => false,
                'message' => $this->messages[$this->lang]['not_found'],
                'status'  => 404,
            ];
        }

        if (is_null($user->deleted_at)) {
            return [
                'success' => false,
                'message' => $this->messages[$this->lang]['not_deleted'],
                'status'  => 400,
            ];
        }

        if (! Hash::check($password, $user->password)) {
            return [
                'success' => false,
                'message' => $this->messages[$this->lang]['invalid_pass'],
                'status'  => 403,
            ];
        }

        // Restore user
        $user->restore();

        return [
            'success' => true,
            'message' => $this->messages[$this->lang]['restored'],
            'status'  => 200,
        ];
    }
}
