<?php

namespace App\Listeners\CodeUserVerification;

use App\Entities\BillPayments\Services\Interfaces\BillPaymentServiceInterface;
use App\Mail\BillPayments\SendExpirationTimeAlert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class SendCodeUserVerificationListeners
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        dd('hola');

        $date = Carbon::now();
        Mail::to(['email' => '123romerod@gmail.com'])->send(new SendExpirationTimeAlert(['data' => $data, 'date' => $date]));
    }
}
