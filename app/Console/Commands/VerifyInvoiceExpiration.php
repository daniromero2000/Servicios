<?php

namespace App\Console\Commands;

use App\Events\BillPayments\VerifyInvoiceExpiration as BillPaymentsVerifyInvoiceExpiration;
use Illuminate\Console\Command;

class VerifyInvoiceExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verifyInvoiceExpiration';

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
        event(new BillPaymentsVerifyInvoiceExpiration());
    }
}
