<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class DynamicEmail extends Mailable
{
    public $title;
    public $content;
    public $lang;

    public function __construct($title, $content, $lang)
    {
        $this->title = $title;
        $this->content = $content;
        $this->lang = $lang;
    }

    public function build()
    {
        return $this->subject($this->title)
            ->view('emails.dynamic'); // our custom blade
    }
}
