<?php

declare(strict_types=1);

namespace App\Support;

final class Installer
{
    public const LOCK_BASENAME = 'installer.lock';

    public static function lockPath(): string
    {
        return storage_path('app/'.self::LOCK_BASENAME);
    }

    public static function isLocked(): bool
    {
        return is_file(self::lockPath());
    }
}
