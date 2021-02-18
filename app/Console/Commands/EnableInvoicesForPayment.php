<?php

namespace App\Console\Commands;

use App\Events\BillPayments\EnableInvoicesForPayment as BillPaymentsEnableInvoicesForPayment;
use Illuminate\Console\Command;

class EnableInvoicesForPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enableInvoicesForPayment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        event(new BillPaymentsEnableInvoicesForPayment());
    }
}
