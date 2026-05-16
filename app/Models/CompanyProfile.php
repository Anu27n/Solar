<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CompanyProfile extends Model
{
    protected $fillable = [
        'code', 'name', 'logo_path', 'tagline',
        'address_office', 'address_factory', 'city', 'state', 'pincode',
        'gstin', 'phones', 'email', 'website',
        'bank_name', 'bank_branch', 'bank_ac_no', 'bank_ifsc', 'bank_pin',
        'signatory_name', 'signatory_title', 'signatory_phone',
        'ref_prefix', 'next_quotation_seq', 'ref_year_mode',
        'default_gst_percent', 'default_validity_days',
        'default_payment_terms', 'default_delivery_terms', 'default_warranty_terms',
        'default_freight', 'default_jurisdiction', 'default_cover_letter',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'phones' => 'array',
            'default_gst_percent' => 'decimal:2',
            'default_validity_days' => 'integer',
            'next_quotation_seq' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    public function catalogItems(): HasMany
    {
        return $this->hasMany(CatalogItem::class);
    }

    public function phonesList(): string
    {
        $phones = $this->phones ?? [];
        return implode(', ', array_filter(array_map('trim', $phones)));
    }

    /**
     * Atomically allocate and format the next quotation reference number for this company.
     * Format examples:
     *   UPK/102/2026             (calendar year)
     *   UPRS/01/2026             (calendar year)
     *   UPR/A/602/2026-27        (fiscal year Apr-Mar)
     */
    public function generateNextReference(?Carbon $date = null): string
    {
        $date = $date ?? Carbon::now();

        return DB::transaction(function () use ($date) {
            $fresh = static::whereKey($this->id)->lockForUpdate()->first();
            $seq = (int) $fresh->next_quotation_seq;
            $fresh->next_quotation_seq = $seq + 1;
            $fresh->save();
            $this->next_quotation_seq = $fresh->next_quotation_seq;

            $yearPart = $this->ref_year_mode === 'fiscal'
                ? $this->fiscalYear($date)
                : (string) $date->year;

            return sprintf('%s/%s/%s', $this->ref_prefix, str_pad((string) $seq, 2, '0', STR_PAD_LEFT), $yearPart);
        });
    }

    protected function fiscalYear(Carbon $date): string
    {
        $y = (int) $date->year;
        $m = (int) $date->month;
        if ($m >= 4) {
            return sprintf('%d-%02d', $y, ($y + 1) % 100);
        }
        return sprintf('%d-%02d', $y - 1, $y % 100);
    }
}
