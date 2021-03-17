<?php

namespace App\Listeners\CodeUserVerification;

use App\Entities\CustomerVerificationCodes\Repositories\Interfaces\CustomerVerificationCodeRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class SendCodeUserVerificationListeners
{
    private $customerVerificationCodeInterface;

    public function __construct(
        CustomerVerificationCodeRepositoryInterface $customerVerificationCodeRepositoryInterface
    ) {
        $this->customerVerificationCodeInterface = $customerVerificationCodeRepositoryInterface;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->customerVerificationCodeInterface->reSendMessage();
    }
}
