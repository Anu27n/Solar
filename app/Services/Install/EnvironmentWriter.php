<?php

declare(strict_types=1);

namespace App\Services\Install;

final class EnvironmentWriter
{
    /** Strip DB_* lines (commented or not) so mysql overrides are the single source of truth. */
    public static function stripDatabaseLines(string $content): string
    {
        $content = (string) preg_replace('/^\s*#?\s*DB_[A-Z0-9_]+\s*=.*\R?/m', '', $content);

        return (string) preg_replace("/^\s*#?\s*DB_URL\s*=.*\R?/m", '', $content);
    }

    /**
     * @param  array<string, string>  $overrides
     */
    public static function mergeIntoExample(string $exampleContent, array $overrides): string
    {
        $lines = preg_split('/\r\n|\n|\r/', $exampleContent) ?: [];
        $handled = [];

        $out = [];
        foreach ($lines as $line) {
            if (preg_match('/^\s*([A-Z_][A-Z0-9_]*)\s*=/', $line, $m)) {
                $key = $m[1];
                if (array_key_exists($key, $overrides)) {
                    $out[] = $key.'='.self::escape((string) $overrides[$key]);
                    $handled[$key] = true;

                    continue;
                }
            }
            $out[] = $line;
        }

        foreach ($overrides as $key => $value) {
            if (isset($handled[$key])) {
                continue;
            }
            $out[] = $key.'='.self::escape((string) $value);
        }

        return implode("\n", $out)."\n";
    }

    private static function escape(string $value): string
    {
        $needsQuotes = strpbrk($value, " \t\n\r\0\"'\\#$") !== false || str_contains($value, '${');

        if (! $needsQuotes) {
            return $value;
        }

        $escaped = str_replace(['\\', '"'], ['\\\\', '\"'], $value);

        return '"'.$escaped.'"';
    }
}
