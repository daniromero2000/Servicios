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
        $schedule->command('sendCodeUserVerification')->everyMinute()->days([1, 2, 3, 4, 5, 6]);
    }

//     director108.sin@lagobo.com.co
// director109.gra@lagobo.com.co
// director111.vil@lagobo.com.co
// director115.plo@lagobo.com.co
// director117.chi@lagobo.com.co
// director121.bar@lagobo.com.co
// director123.tul@lagobo.com.co
// director124.per@lagobo.com.co
// director125.per@lagobo.com.co
// director132.arm@lagobo.com.co
// director133.arm@lagobo.com.co
// director135.man@lagobo.com.co
// director137.dor@lagobo.com.co
// director138.mag@lagobo.com.co
// director139.vnu@lagobo.com.co
// director140.iba@lagobo.com.co
// director141.sin@lagobo.com.co
// director142.mon@lagobo.com.co
// director144.aca@lagobo.com.co
// director146.pit@lagobo.com.co
// director147.gar@lagobo.com.co
// director149.nei@lagobo.com
// director150.cer@lagobo.com.co
// director151.nei@lagobo.com
// director152.arm@lagobo.com.co
// director154.lor@lagobo.com.co
// director155.yop@lagobo.com.co
// director158.esp@lagobo.com.co
// director159.mar@lagobo.com.co
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
