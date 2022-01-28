<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;

class ContactUser extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if (Session::get('applocale') === 'en') {
            $msgSuccess = 'Copy of your message sent to ';
            return $this->markdown('emails.en.contact-user')->with('data',
            $this->data)->subject( $msgSuccess . env('APP_NAME'));

        } elseif (Session::get('applocale') === 'nl') {
            $msgSuccess = 'Kopie van uw bericht gestuurd naar ';
            return $this->markdown('emails.nl.contact-user')->with('data',
            $this->data)->subject( $msgSuccess . env('APP_NAME'));

        } else {
            $msgSuccess = 'Copie de votre message envoyé sur';
            return $this->markdown('emails.contact-user ')->with('data',
                $this->data)->subject( $msgSuccess . env('APP_NAME'));
        }
    }
}
