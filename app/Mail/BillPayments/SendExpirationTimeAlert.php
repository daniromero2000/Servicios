<?php

namespace App\Mail\BillPayments;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\ErrorHandler\Collecting;

class SendExpirationTimeAlert extends Mailable
{
    use Queueable, SerializesModels;
    private $expiredRenewals;

    public function __construct(array $billPayments)
    {
        $this->billpayment = $billPayments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Tiempo de vigencia excedido')->view('mail.billPayment.sendExpirationTimeAlert', $this->billpayment);
    }
}
