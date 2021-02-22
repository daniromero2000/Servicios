<?php

namespace App\Console\Commands;

use App\Events\BillPayments\VerifyManagedInvoices as BillPaymentsVerifyManagedInvoices;
use Illuminate\Console\Command;

class VerifyManagedInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verifyManagedInvoices';

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
        event(new BillPaymentsVerifyManagedInvoices());
    }
}
