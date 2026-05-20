<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Portable ORDER BY for fixed value sequences (MySQL FIELD() is not available in SQLite).
 */
final class DbOrder
{
    /**
     * @param  list<string>  $values  Preferred order (first = sort priority 1)
     */
    public static function case(string $column, array $values, int $elseRank = 99): string
    {
        $when = [];
        foreach ($values as $index => $value) {
            $escaped = str_replace("'", "''", $value);
            $when[] = "WHEN '{$escaped}' THEN ".($index + 1);
        }

        return 'CASE '.$column.' '.implode(' ', $when).' ELSE '.$elseRank.' END';
    }
}
