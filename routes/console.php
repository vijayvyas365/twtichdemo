<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
	$streamInfo = ["hello"=>"hi"];
	$userId = 1;
	event(new App\Events\EventsNotification($streamInfo,$userId));
    // $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');
