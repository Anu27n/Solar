<?php

use App\Support\Installer;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('installer:lock', function () {
    File::put(Installer::lockPath(), json_encode([
        'locked_at' => now()->toIso8601String(),
        'via' => 'artisan',
    ], JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
    $this->info('Installer locked at '.Installer::lockPath());
})->purpose('Create storage/app/installer.lock (skip web wizard on local / CI)');
