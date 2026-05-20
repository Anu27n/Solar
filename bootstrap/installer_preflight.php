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

function installer_env_app_key_is_set(string $content): bool
{
    if (! preg_match('/^APP_KEY=(.*)$/m', $content, $m)) {
        return false;
    }

    $value = trim($m[1]);
    $value = trim($value, "'\"");

    return $value !== '' && strtolower($value) !== 'null';
}

/**
 * Ensures a writable .env with APP_KEY and file-based session/cache before Laravel boots.
 * Re-runs when .env exists but APP_KEY is empty (e.g. copied from .env.example on shared hosting).
 */
function installer_ensure_stub_env(string $basePath): void
{
    $envPath = $basePath.DIRECTORY_SEPARATOR.'.env';
    $example = $basePath.DIRECTORY_SEPARATOR.'.env.example';

    if (is_file($envPath)) {
        $content = (string) file_get_contents($envPath);
    } elseif (is_readable($example)) {
        $content = (string) file_get_contents($example);
    } else {
        $content = "APP_NAME=Laravel\nAPP_ENV=local\nAPP_KEY=\nAPP_DEBUG=true\nAPP_URL=http://localhost\n";
    }

    $changed = false;

    if (! installer_env_app_key_is_set($content)) {
        $content = installer_set_env_line($content, 'APP_KEY', 'base64:'.base64_encode(random_bytes(32)));
        $changed = true;
    }

    foreach ([
        'SESSION_DRIVER' => 'file',
        'CACHE_STORE' => 'file',
        'QUEUE_CONNECTION' => 'sync',
    ] as $key => $value) {
        if (preg_match('/^'.preg_quote($key, '/').'=(.*)$/m', $content, $m)) {
            $current = trim($m[1], " \t\"'");
            if ($current === 'database' || $current === '') {
                $content = installer_set_env_line($content, $key, $value);
                $changed = true;
            }
        } else {
            $content = installer_set_env_line($content, $key, $value);
            $changed = true;
        }
    }

    if (! is_file($envPath) || $changed) {
        if (@file_put_contents($envPath, $content) === false) {
            $fallback = installer_app_key_fallback_path($basePath);
            if (preg_match('/^APP_KEY=(.+)$/m', $content, $m)) {
                $key = trim(trim($m[1]), "'\"");
                if ($key !== '') {
                    @file_put_contents($fallback, $key);
                }
            }
        }
    }
}

function installer_app_key_fallback_path(string $basePath): string
{
    return $basePath.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'installer_app_key';
}

function installer_read_app_key_from_disk(string $basePath): string
{
    $envPath = $basePath.DIRECTORY_SEPARATOR.'.env';
    if (is_readable($envPath)) {
        $content = (string) file_get_contents($envPath);
        if (installer_env_app_key_is_set($content) && preg_match('/^APP_KEY=(.+)$/m', $content, $m)) {
            return trim(trim($m[1]), "'\"");
        }
    }

    $fallback = installer_app_key_fallback_path($basePath);
    if (is_readable($fallback)) {
        $key = trim((string) file_get_contents($fallback));

        return $key !== '' ? $key : '';
    }

    return '';
}

/**
 * Laravel reads APP_KEY during bootstrap; inject before autoload if .env is missing or not writable.
 */
function installer_export_app_key_to_runtime(string $basePath): void
{
    $key = installer_read_app_key_from_disk($basePath);
    if ($key === '') {
        $key = 'base64:'.base64_encode(random_bytes(32));
        @file_put_contents(installer_app_key_fallback_path($basePath), $key);
    }

    putenv('APP_KEY='.$key);
    $_ENV['APP_KEY'] = $key;
    $_SERVER['APP_KEY'] = $key;
}

function installer_clear_stale_config_cache(string $basePath): void
{
    $configCache = $basePath.DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'config.php';
    if (is_file($configCache)) {
        @unlink($configCache);
    }
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
