<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        $verifyUrl = $this->verificationUrl($notifiable);
        $locale = app()->getLocale();

        $mail = (new MailMessage)
            ->subject(__('email.Verify Your Email Address'));

        if ($locale === 'ar') {

            // 🌙 Arabic Version
            $mail->greeting('أهلاً!')
                ->line('مرحباً في أول تطبيق زواج أردني يتوافق مع تقاليدنا وقيمنا. يقدم هذا التطبيق طريقة حديثة لتلبية احتياجاتك مع احترام قيم المجتمع.')
                ->line('يرجى إرسال رمز التحقق التالي من خلال التطبيق.')
                ->action('تأكيد البريد الإلكتروني', $verifyUrl)
                ->line('شكراً لاستخدامكم تطبيقنا!');
        } else {

            // 🌞 English Version
            $mail->greeting('Welcome!')
                ->line('Welcome to the first Jordanian marriage application that aligns with our traditions and values. This app offers a modern way to meet your needs while respecting community values.')
                ->line('Please send the following verification code through the application.')
                ->action('Verify Email Address', $verifyUrl)
                ->line('Thank you for using our application!');
        }

        return $mail;
    }
}
