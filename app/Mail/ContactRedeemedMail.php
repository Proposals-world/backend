<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactRedeemedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $lang;

    public function __construct($user, $lang = 'en')
    {
        $this->user = $user;
        $this->lang = $lang;
    }

    public function build()
    {
        app()->setLocale($this->lang);

        return $this->subject(__('email.title'))
            ->view('emails.contact_redeemed')
            ->with([
                'user' => $this->user,
            ]);
    }
}
