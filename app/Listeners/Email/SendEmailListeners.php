<?php

namespace App\Listeners\Email;

use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class SendEmailListeners
{

    public function __construct(
    ) {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to(['email' => '123romerod@gmail.com'])->send(new SendEmail());
    }
}
