<?php

declare(strict_types=1);

use App\Http\Controllers\Install\InstallerController;
use App\Http\Middleware\RedirectIfInstallerLocked;
use Illuminate\Support\Facades\Route;

Route::middleware([RedirectIfInstallerLocked::class, 'throttle:60,1'])->group(function (): void {
    Route::get('/', [InstallerController::class, 'welcome'])->name('welcome');
    Route::get('/requirements', [InstallerController::class, 'requirements'])->name('requirements');
    Route::post('/requirements', [InstallerController::class, 'requirementsContinue'])->name('requirements.continue');
    Route::get('/database', [InstallerController::class, 'databaseForm'])->name('database');
    Route::post('/database', [InstallerController::class, 'databaseSave'])->name('database.save');
    Route::get('/configuration', [InstallerController::class, 'configurationForm'])->name('configuration');
    Route::post('/configuration', [InstallerController::class, 'configurationSave'])->name('configuration.save');
    Route::get('/migrate', [InstallerController::class, 'migrateForm'])->name('migrate');
    Route::post('/migrate', [InstallerController::class, 'migrateRun'])->name('migrate.run');
    Route::get('/admin', [InstallerController::class, 'adminForm'])->name('admin');
    Route::post('/admin', [InstallerController::class, 'adminSave'])->name('admin.save');
    Route::get('/finish', [InstallerController::class, 'finish'])->name('finish');
    Route::post('/finish', [InstallerController::class, 'lock'])->name('finish.lock');
});
