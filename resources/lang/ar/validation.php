<?php

return [

    /*
    |--------------------------------------------------------------------------
    | أسطر لغة التحقق
    |--------------------------------------------------------------------------
    */

    'required'             => 'حقل :attribute مطلوب.',
    'string'               => 'يجب أن يكون :attribute نصاً.',
    'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صالحاً.',
    'max'                  => [
        'string' => 'لا يجوز أن يكون :attribute أكبر من :max حرف.',
    ],
    'min'                  => [
        'string' => 'يجب أن يكون :attribute على الأقل :min حرفاً.',
    ],
    'confirmed'            => 'تأكيد :attribute غير مطابق.',
    'unique'               => 'تم استخدام :attribute من قبل.',
    'in'                   => ':attribute المحدد غير صالح.',
    'regex'                => 'صيغة :attribute غير صالحة.',

    /*
    |--------------------------------------------------------------------------
    | أسطر لغة تحقق مخصصة
    |--------------------------------------------------------------------------
    */

    'password' => [
        'complexity' => 'يجب أن يحتوي :attribute على حرف كبير واحد على الأقل، حرف صغير واحد، رقم واحد ورمز واحد.',
    ],

    'custom' => [
        'email' => [
            'lowercase' => 'يجب أن تكون قيمة البريد الإلكتروني كلها أحرفًا صغيرة.',
        ],
        'phone_number' => [
            'regex' => 'يجب أن يكون رقم الهاتف 10 أرقام ويبدأ بـ 078 أو 077 أو 079.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | تسميات الحقول المخصصة
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'first_name'   => 'الاسم الأول',
        'last_name'    => 'اسم العائلة',
        'email'        => 'البريد الإلكتروني',
        'phone_number' => 'رقم الهاتف',
        'gender'       => 'الجنس',
        'password'     => 'كلمة المرور',
    ],

];
