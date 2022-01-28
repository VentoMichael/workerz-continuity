<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;

class NewUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (Session::get('applocale') === 'en') {
            $msgSuccess = 'This is just the beginning of a great adventure!';
        } elseif (Session::get('applocale') === 'nl') {
            $msgSuccess = 'Dit is nog maar het begin van een groot avontuur!';
        } else {
            $msgSuccess = 'Ce n\'est que le début d\'une grande aventure !';
        }
        return $this->markdown('emails.newUser-for-user')->with(
            'user',
            $this->user
        )->subject($msgSuccess);
    }
}
