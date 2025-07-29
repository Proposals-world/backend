<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function store(Request $request)
    {
        $messages = [
            'name.required'    => $request->header('lang') === 'ar' ? 'الاسم مطلوب' : 'Name is required',
            'name.string'      => $request->header('lang') === 'ar' ? 'يجب أن يكون الاسم نصاً' : 'Name must be a string',
            'name.max'         => $request->header('lang') === 'ar' ? 'يجب ألا يزيد الاسم عن 255 حرفاً' : 'Name may not be greater than 255 characters',
            'email.required'   => $request->header('lang') === 'ar' ? 'البريد الإلكتروني مطلوب' : 'Email is required',
            'email.email'      => $request->header('lang') === 'ar' ? 'صيغة البريد الإلكتروني غير صحيحة' : 'Email format is invalid',
            'email.max'        => $request->header('lang') === 'ar' ? 'يجب ألا يزيد البريد الإلكتروني عن 255 حرفاً' : 'Email may not be greater than 255 characters',
            'phone.required'   => $request->header('lang') === 'ar' ? 'رقم الهاتف مطلوب' : 'Phone is required',
            'phone.string'     => $request->header('lang') === 'ar' ? 'يجب أن يكون رقم الهاتف نصاً' : 'Phone must be a string',
            'phone.max'        => $request->header('lang') === 'ar' ? 'يجب ألا يزيد رقم الهاتف عن 30 حرفاً' : 'Phone may not be greater than 30 characters',
            'message.required' => $request->header('lang') === 'ar' ? 'الرسالة مطلوبة' : 'Message is required',
            'message.string'   => $request->header('lang') === 'ar' ? 'يجب أن تكون الرسالة نصاً' : 'Message must be a string',
        ];

        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:30',
            'message' => 'required|string',
        ], $messages);

        // Determine locale from header or fallback to app locale
        $locale = $request->header('lang', app()->getLocale());

        $message = ContactMessage::create($data);

        return response()->json([
            'success' => true,
            'message' => $locale === 'ar' ? 'تم إرسال رسالتك بنجاح' : 'Your message has been sent successfully',
            'data'    => $message,
        ], 201);
    }
}
