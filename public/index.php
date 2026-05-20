<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$installerBase = dirname(__DIR__);
require_once $installerBase.'/bootstrap/installer_preflight.php';

if (! installer_is_locked()) {
    installer_ensure_stub_env($installerBase);
    installer_export_app_key_to_runtime($installerBase);
    installer_clear_stale_config_cache($installerBase);
}

if (installer_should_redirect_to_wizard()) {
    header('Location: /install', true, 302);
    exit;
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
