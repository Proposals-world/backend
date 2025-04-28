<?php
// app/Mail/MatchNotification.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class MatchNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user1;
    public $user2;

    public function __construct(User $user1, User $user2)
    {
        $this->user1 = $user1;
        $this->user2 = $user2;
    }

    public function build()
    {
        return $this->subject(__('email.subject_match'))
            ->view('emails.match_notification');
    }
}
