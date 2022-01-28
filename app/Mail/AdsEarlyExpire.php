<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdsEarlyExpire extends Mailable
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
            $msgSuccess = 'Don\'t forget your ad will expire soon, come and update it !';
        } elseif (Session::get('applocale') === 'nl') {
            $msgSuccess = 'Uw nieuwe advertentie staat online';
        } else {
            $msgSuccess = 'N\'oubliez pas votre annonce va bientôt expirer, venez la mettre à jour !';
        }
        return $this->markdown('emails.add-early-expire')->with('data',
            $this->data)->subject($msgSuccess);
    }
}
