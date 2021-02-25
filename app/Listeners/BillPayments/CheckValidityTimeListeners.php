<?php

namespace App\Listeners\BillPayments;

use App\Entities\BillPayments\Services\Interfaces\BillPaymentServiceInterface;

class CheckValidityTimeListeners
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
        $this->billPaymentInterface->checkValidityTime();
    }
}
