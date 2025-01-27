<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetOTPMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $email;
    public $userName;

    /**
     * Create a new message instance.
     *
     * @param int $otp The 6-digit OTP
     * @param string $email The user's email address
     * @param string $userName The user's name
     */
    public function __construct($otp, $email, $userName)
    {
        $this->otp = $otp;
        $this->email = $email;
        $this->userName = $userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Password Reset OTP')
                    ->view('emails.password_reset_otp');
    }
}