<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Blade;

class UserEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        string $recipient,
        public $subject,
        string $message,
    )
    {
        $this->to($recipient);
        $this->html(Blade::render('{{ $message }}', ['message' => $message]));
    }
}
