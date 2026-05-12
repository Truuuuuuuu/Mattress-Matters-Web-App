<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

/*Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');*/

Schedule::command('invoices:generate-monthly')->daily()->withoutOverlapping()->runInBackground();
Schedule::command('payments:expire-pending')->everyFiveMinutes()->withoutOverlapping()->runInBackground();
Schedule::command('rental:process-moveouts')->daily()->withoutOverlapping()->runInBackground();
Schedule::command('invoices:mark-overdue')->hourly()->withoutOverlapping()->runInBackground();
Schedule::command('reservation:expire')->hourly()->withoutOverlapping()->runInBackground();

