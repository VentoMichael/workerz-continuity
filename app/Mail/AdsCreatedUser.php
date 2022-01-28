<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdsCreatedUser extends Mailable
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
            $msgSuccess = 'Your new ad is online';
        } elseif (Session::get('applocale') === 'nl') {
            $msgSuccess = 'Uw nieuwe advertentie staat online';
        } else {
            $msgSuccess = 'Votre nouvelle annonce est en ligne';
        }
        return $this->markdown('emails.ads-for-user')->with('data',
            $this->data)->subject($msgSuccess);
    }
}
