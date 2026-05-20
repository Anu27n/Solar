<?php

declare(strict_types=1);

namespace App\Support;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

/**
 * Two-page card PDFs via DomPDF (no FPDI/FPDF — works on SQLite and MySQL hosts).
 */
final class StationeryCardPdf
{
    /** CR80 ID card size in points (85.6 x 53.98 mm). */
    public static function idCardPaper(): array
    {
        $w = 85.6 * 72 / 25.4;
        $h = 53.98 * 72 / 25.4;

        return [$w, $h];
    }

    /** Standard business card in points (89 x 51 mm). */
    public static function visitingCardPaper(): array
    {
        $w = 89 * 72 / 25.4;
        $h = 51 * 72 / 25.4;

        return [$w, $h];
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public static function download(
        string $view,
        array $data,
        float $widthPt,
        float $heightPt,
        string $filename,
    ): Response {
        $pdf = Pdf::loadView($view, $data)
            ->setPaper([0, 0, $widthPt, $heightPt], 'portrait')
            ->setOptions([
                'dpi' => 96,
                'defaultFont' => 'DejaVu Sans',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'enable_php' => false,
            ]);

        return $pdf->download($filename);
    }
}
