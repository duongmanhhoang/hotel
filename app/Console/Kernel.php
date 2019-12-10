<?php

namespace App\Console;

use App\Console\Commands\ChangeSaleStatus;
use App\Console\Commands\CheckExpireTokenActiveUser;
use App\Console\Commands\DailyInsertStatisticals;
use App\Models\Statistical;
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
        DailyInsertStatisticals::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

//        $schedule->command(DailyInsertStatisticals::class)->dailyAt('00:05')->appendOutputTo(storage_path('logs/scheduler.log'));
//        $schedule->command(ChangeSaleStatus::class)->everyMinute()->appendOutputTo(storage_path('logs/changeStatus.log'));
//        $schedule->command(ChangeSaleStatus::class)->dailyAt('00:05')->appendOutputTo(storage_path('logs/invoices.log'));
        $schedule->command(CheckExpireTokenActiveUser::class)->everyMinute()->appendOutputTo(storage_path('logs/checkExpire.log'));

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
