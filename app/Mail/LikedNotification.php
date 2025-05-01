<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class LikedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $liker;  // the user who liked

    public function __construct(User $liker)
    {
        $this->liker = $liker;
    }

    public function build()
    {
        return $this->subject(__('email.subject'))
            ->view('emails.liked_notification');
    }
}
