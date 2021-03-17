<?php

namespace App\Mail\CodeUserVerification;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCodeUserVerification extends Mailable
{
    use Queueable, SerializesModels;
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Token de seguridad Almancenes Oportunidades')->view('mail.codeUserVerification.sendCodeUserVerification', ['data' => $this->token]);
    }
}
