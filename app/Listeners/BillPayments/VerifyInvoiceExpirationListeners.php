<?php

namespace App\Listeners\Email;

use App\Entities\BillPayments\Services\Interfaces\BillPaymentServiceInterface;

class VerifyInvoiceExpirationListeners
{
    private $billPaymentInterface;

    public function __construct(
        BillPaymentServiceInterface $BillPaymentServiceInterface
    ) {
        $this->billPaymentInterface = $BillPaymentServiceInterface;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->billPaymentInterface->checkInvoices();
    }
}
