<?php

namespace App\Console;

use App\Models\Rents;
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
        $schedule->call(function(){
            $rents = Rents::whereRaw('lease_end_date < CURRENT_TIMESTAMP()')
                ->where('status', '<>', 'finished')
                ->where('status', '<>', 'late')
                ->get();

            foreach ($rents as $rent)
            {
                $rent->status = 'late';
                if (!$rent->save())
                    throw new \Exception("error in update rent status to late");
            }
        })->everyMinute();
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
