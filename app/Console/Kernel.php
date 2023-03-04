<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('send:notification')->timezone('Asia/Kolkata')->daily('');
        $schedule->command('mail:bulk')->timezone('Asia/Kolkata')->dailyAt('09:30');
        $schedule->command('mail:individual')->timezone('Asia/Kolkata')->dailyAt('09:30');
        $schedule->command('pickrr:order')->everyFifteenMinutes();
        // $schedule->command('email:queuejob')->everyTwoMinutes();
        $schedule->command('queue:work')->everyMinute()->withoutOverlapping();   
        $schedule->command('sendgrid:opencount')->twiceDaily();     
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
