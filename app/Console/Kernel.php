<?php
// app/Console/Kernel.php

namespace App\Console;

use App\Console\Commands\AppInstall; // Importáld az új parancsot
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Az alkalmazás konzolos parancsainak regisztrálása.
     *
     * @var array
     */
    protected $commands = [
        AppInstall::class, // Itt regisztrálod az új parancsot
    ];

    /**
     * Az alkalmazás konzolos ütemezése.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Ütemezett parancsok hozzáadása (ha szükséges)
    }

    /**
     * A konzolos parancsok beállítása.
     *
     * @return void
     */
    protected function commands()
    {
        // Az összes parancs automatikus betöltése
        $this->load(__DIR__.'/Commands');

        // Egyéb parancsok betöltése (ha szükséges)
        require base_path('routes/console.php');
    }
}
