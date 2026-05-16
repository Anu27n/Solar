<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Embeds storage/app/public files as data URIs for DomPDF (reliable vs file:// paths).
 */
final class PdfImageDataUri
{
    public static function fromPublicPath(?string $relativePath): ?string
    {
        if ($relativePath === null || $relativePath === '') {
            return null;
        }

        if (str_contains($relativePath, '..') || str_starts_with($relativePath, '/')) {
            return null;
        }

        $full = storage_path('app/public/'.$relativePath);
        if (! is_file($full) || ! is_readable($full)) {
            return null;
        }

        $mime = @mime_content_type($full) ?: 'image/jpeg';
        if (! str_starts_with($mime, 'image/')) {
            return null;
        }

        $raw = @file_get_contents($full);
        if ($raw === false) {
            return null;
        }

        return 'data:'.$mime.';base64,'.base64_encode($raw);
    }
}
