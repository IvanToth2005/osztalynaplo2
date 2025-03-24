<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;  // Add this line

class AppInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    protected $description = 'Telepíti az alkalmazást: létrehozza az adatbázist, generálja az APP_KEY-t, futtatja a migrációkat és seedeket.';
 
    public function handle()
    {
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');
    
        if (empty(env('APP_KEY'))) {
            $this->info("APP_KEY generálása...\n");
            Artisan::call('key:generate');
        }
        $this->info("Migrációk futtatása...\n");
        Artisan::call('migrate --force');
       
        $this->info("Adatbázis feltöltése seed adatokkal...\n");
        Artisan::call('db:seed', ['--force' => true]);
 
        $this->info("Az alkalmazás sikeresen telepítve!\n");
    }
}
