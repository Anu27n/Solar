<?php

declare(strict_types=1);

/**
 * Runs before Composer autoload so Laravel can boot on first /install visit without a .env file.
 *
 * Local development: if you already have a working .env and database, run `php artisan installer:lock`
 * so the site is not redirected to /install.
 */
function installer_base_path_from_public(): string
{
    return dirname(__DIR__);
}

function installer_lock_path(): string
{
    return installer_base_path_from_public().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'installer.lock';
}

function installer_is_locked(): bool
{
    return is_file(installer_lock_path());
}

function installer_request_path(): string
{
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = parse_url($uri, PHP_URL_PATH);

    return is_string($path) && $path !== '' ? $path : '/';
}

function installer_should_redirect_to_wizard(): bool
{
    $path = installer_request_path();

    if ($path === '/up') {
        return false;
    }

    if ($path === '/install' || str_starts_with($path, '/install/')) {
        return false;
    }

    return ! installer_is_locked();
}

function installer_ensure_stub_env(string $basePath): void
{
    $envPath = $basePath.DIRECTORY_SEPARATOR.'.env';
    if (is_file($envPath)) {
        return;
    }

    $example = $basePath.DIRECTORY_SEPARATOR.'.env.example';
    $content = is_readable($example) ? (string) file_get_contents($example) : '';

    if ($content === '') {
        $content = "APP_NAME=Laravel\nAPP_ENV=local\nAPP_KEY=\nAPP_DEBUG=true\nAPP_URL=http://localhost\n";
    }

    $key = 'base64:'.base64_encode(random_bytes(32));
    $content = installer_set_env_line($content, 'APP_KEY', $key);
    $content = installer_set_env_line($content, 'SESSION_DRIVER', 'file');
    $content = installer_set_env_line($content, 'CACHE_STORE', 'file');
    $content = installer_set_env_line($content, 'QUEUE_CONNECTION', 'sync');

    @file_put_contents($envPath, $content);
}

/**
 * @param  non-empty-string  $value  Raw unquoted value (no surrounding quotes)
 */
function installer_set_env_line(string $content, string $key, string $value): string
{
    $pattern = '/^'.preg_quote($key, '/').'=.*/m';
    $line = $key.'='.$value;
    if (preg_match($pattern, $content)) {
        return (string) preg_replace($pattern, $line, $content);
    }

    return rtrim($content)."\n".$line."\n";
}
