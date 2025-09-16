<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserChangeEmailPinMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pin;
    public $newEmail;

    public function __construct($pin, $newEmail)
    {
        $this->pin = $pin;
        $this->newEmail = $newEmail;
    }

    public function build()
    {
        return $this->subject('PIN para cambiar tu email y contraseña')
            ->view('emails.user_change_email_pin');
    }
}
