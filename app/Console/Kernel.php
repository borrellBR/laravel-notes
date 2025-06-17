<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    // No nos sirve ahora mismo, es para configurar que un comando se ejecute cada cierto tiempo
    protected function schedule(Schedule $schedule)
    {
     $schedule->command('reminders:send')->dailyAt("09:57");
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
