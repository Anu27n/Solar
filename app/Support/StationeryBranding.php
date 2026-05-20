<?php

declare(strict_types=1);

namespace App\Support;

use App\Models\CompanyProfile;
use Illuminate\Support\Collection;

final class StationeryBranding
{
    public const GROUP_TITLE = 'UPR SOLAR, UPK ELECTRICAL & UP REFRIGERATION AND SALES CO';

    /**
     * @return Collection<int, CompanyProfile>
     */
    public static function companies(): Collection
    {
        return CompanyProfile::query()
            ->where('is_active', true)
            ->orderByRaw(DbOrder::case('code', ['upr_solar', 'upr_refrigeration', 'upk_electrical']))
            ->orderBy('name')
            ->get();
    }

    /**
     * @return list<array{profile: CompanyProfile, logoDataUri: ?string, shortLabel: string}>
     */
    public static function companiesForPdf(): array
    {
        $short = [
            'upr_solar' => 'UPR Solar',
            'upr_refrigeration' => 'UP Refrigeration',
            'upk_electrical' => 'UPK Electrical Pvt. Ltd.',
        ];

        return self::companies()->map(function (CompanyProfile $profile) use ($short) {
            return [
                'profile' => $profile,
                'logoDataUri' => PdfImageDataUri::fromPublicPath($profile->logo_path),
                'shortLabel' => $short[$profile->code] ?? $profile->name,
            ];
        })->values()->all();
    }

    /**
     * @return list<string>
     */
    public static function backServices(): array
    {
        return [
            'Solar power plants — rooftop, on-grid, off-grid & hybrid',
            'Solar pumps, modules, inverters & battery storage',
            'Refrigeration systems, cold storage & ice plants',
            'Dairies, breweries, chilling & frozen-food plants',
            'HT / LT transformers, panels, UPS & stabilizers',
            'Servo stabilizers, VCB, OLTC & electrical switchgear',
            'Design, supply, installation & after-sales service',
        ];
    }

    public static function primaryOffice(): CompanyProfile
    {
        return self::companies()->first()
            ?? CompanyProfile::query()->firstOrFail();
    }
}
