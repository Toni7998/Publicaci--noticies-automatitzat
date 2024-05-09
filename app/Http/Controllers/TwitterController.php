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
        // Programa una tarea para ejecutarse diariamente
        $schedule->call(function () {
            // Aquí llamas al método del controlador que publica los tweets
            app('App\Http\Controllers\TwitterController')->publicarTweet('Text del tweet');
        })->daily(); // Ejecuta esta tarea cada día
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // Carga los comandos de la aplicación
        $this->load(__DIR__ . '/Commands');

        // Requiere las rutas de consola de la aplicación
        require base_path('routes/console.php');
    }
    
}
