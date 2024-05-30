<?php

use Illuminate\Foundation\Inspiring;
use App\Console\Commands\DailyDigestCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('send:daily-digest', function () {
    $this->call(DailyDigestCommand::class);
})->purpose("Send daily email digest of the top posts to all users");

Schedule::command("send:daily-digest")->daily();
