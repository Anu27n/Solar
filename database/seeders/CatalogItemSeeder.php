<?php

namespace Database\Seeders;

use App\Models\CatalogItem;
use App\Models\CompanyProfile;
use Illuminate\Database\Seeder;

class CatalogItemSeeder extends Seeder
{
    public function run(): void
    {
        $byCode = CompanyProfile::query()->pluck('id', 'code');
        if ($byCode->isEmpty()) {
            return;
        }

        $rows = [
            [
                'company' => 'upk_electrical',
                'sku' => 'UPK-HT-LT-001',
                'name' => 'HT / LT distribution transformers (custom rating)',
                'description' => 'Oil-filled and dry-type transformers — enquiry-based sizing and losses.',
                'unit' => 'Set',
                'list_price' => null,
                'stock_quantity' => 0,
                'position' => 1,
            ],
            [
                'company' => 'upr_solar',
                'sku' => 'SOL-MONO-540',
                'name' => 'Mono PERC solar module ~540W',
                'description' => 'High-efficiency modules for rooftop and ground-mount projects.',
                'unit' => 'Nos',
                'list_price' => 14500,
                'stock_quantity' => 120,
                'position' => 1,
            ],
            [
                'company' => 'upr_solar',
                'sku' => 'SOL-INV-5K',
                'name' => 'Grid-tie / hybrid inverter 5 kVA class',
                'description' => 'Residential and small commercial inverter systems — model per site survey.',
                'unit' => 'Nos',
                'list_price' => 45000,
                'stock_quantity' => 35,
                'position' => 2,
            ],
            [
                'company' => 'upr_refrigeration',
                'sku' => 'REF-COLD-001',
                'name' => 'Cold room equipment package (indicative)',
                'description' => 'Techno-commercial scope per load and room size — detailed BOQ with quotation.',
                'unit' => 'Job',
                'list_price' => null,
                'stock_quantity' => 5,
                'position' => 1,
            ],
        ];

        foreach ($rows as $row) {
            $cid = $byCode[$row['company']] ?? null;
            if (! $cid) {
                continue;
            }
            CatalogItem::updateOrCreate(
                [
                    'company_profile_id' => $cid,
                    'sku' => $row['sku'],
                ],
                [
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'unit' => $row['unit'],
                    'list_price' => $row['list_price'],
                    'stock_quantity' => $row['stock_quantity'],
                    'is_published' => true,
                    'position' => $row['position'],
                ]
            );
        }
    }
}
