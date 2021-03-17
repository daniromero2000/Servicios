<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sitemap:generate')->weekly();
        $schedule->command('checkValidityTime')->dailyAt('06:00')->days([1, 2, 3, 4, 5, 6]);
        $schedule->command('enableInvoicesForPayment')->dailyAt('06:00')->days([1, 2, 3, 4, 5, 6]);
        $schedule->command('verifyInvoiceExpiration')->dailyAt('07:00')->days([1, 2, 3, 4, 5, 6]);
        $schedule->command('verifyManagedInvoices')->dailyAt('08:00')->days([1, 2, 3, 4, 5, 6]);
        $schedule->command('sendCodeUserVerification')->everyTwoMinutes()->days([1, 2, 3, 4, 5, 6]);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
