<?php

namespace App\Mail\InconsistenciesInTheInformation;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNotificationError extends Mailable
{
    use Queueable, SerializesModels;
    private $data;

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
        return $this->subject('Informacion erronea, pagina servicios oportunidades')->view('mail.inconsistenciesInTheInformation.sendNotificationError', ['data' => $this->data]);
    }
}
