<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OTPVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user,$otp)
    {
        $this->otp = $otp;
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your OTP Verification Code')
            ->view('emails.otp_verification') // Use view() instead of markdown()
            ->with([
                'otp' => $this->otp,
                'user' => $this->user,
            ]);
    }
}