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
    Commands\PermitExpiry::class,
    Commands\PublicHoliday::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /***/
       //$schedule->command('queue:work --stop-when-empty')->everyMinute();
     //  $schedule->command('queue:work --stop-when-empty')->withoutOverlapping()->everyFiveMinutes();

$schedule->command('queue:work --once')->everyFiveMinutes();

//        $schedule->command('queue:work --tries=3')
// ->cron('* * * * * *')
// ->withoutOverlapping();
                $schedule->command('public:holiday')->yearly()->timezone('Africa/Dar_es_Salaam');;
               // $schedule->command('public:holiday')->monthlyOn( 15,'14:31')->timezone('Africa/Dar_es_Salaam');;
      
       $schedule->command('permit:expire')->dailyAt('10:30')->timezone('Africa/Dar_es_Salaam');
        //$schedule->command('permit:expire')->monthlyOn( 18,'09:19')->timezone('Africa/Dar_es_Salaam');



         
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        
        require base_path('routes/console.php');
    }
}
