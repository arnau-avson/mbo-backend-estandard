<?php
    namespace App\Mail;
    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    class UserPinMail extends Mailable {
        use Queueable, SerializesModels;
        public $pin;

        public function __construct($pin) {
            $this->pin = $pin;
        }

        public function build() {
            return $this->subject('Tu PIN para crear usuario')
                ->view('emails.user_pin');
        }
    }
