<?php

namespace App\Providers;

use App\Events\BillPayments\EnableInvoicesForPayment;
use App\Events\BillPayments\VerifyInvoiceExpiration;
use App\Events\BillPayments\VerifyManagedInvoices;
use App\Events\Email\SendEmailEvent;
use App\Listeners\BillPayments\EnableInvoicesForPaymentListeners;
use App\Listeners\Email\SendEmailListeners;
use App\Listeners\BillPayments\VerifyInvoiceExpirationListeners;
use App\Listeners\BillPayments\VerifyManagedInvoicesListeners;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SendEmailEvent::class => [
            SendEmailListeners::class,
        ],

        VerifyInvoiceExpiration::class => [
            VerifyInvoiceExpirationListeners::class,
        ],

        EnableInvoicesForPayment::class => [
            EnableInvoicesForPaymentListeners::class,
        ],

        VerifyManagedInvoices::class => [
            VerifyManagedInvoicesListeners::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
