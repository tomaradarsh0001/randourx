<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
    $schedule->command('roi:process')->daily(); // runs once a day
    $schedule->command('salary:check-eligibility')->dailyAt('00:10');

    // run payment command every 15 days at midnight (cron expression)
    $schedule->command('salary:pay')->cron('0 0 */15 * *');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
