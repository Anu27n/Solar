<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quotation extends Model
{
    protected $fillable = [
        'customer_id', 'company_profile_id', 'reference_number', 'location',
        'subject', 'kind_attn',
        'package_id', 'total_price',
        'subtotal', 'gst_percent', 'gst_amount', 'grand_total',
        'validity_days', 'payment_terms', 'delivery_terms', 'warranty_terms',
        'freight', 'jurisdiction', 'notes', 'cover_letter',
        'details',
        'sent_email', 'sent_whatsapp', 'sent_sms', 'created_by',
    ];

    protected function casts(): array
    {
        return [
            'total_price' => 'decimal:2',
            'subtotal' => 'decimal:2',
            'gst_percent' => 'decimal:2',
            'gst_amount' => 'decimal:2',
            'grand_total' => 'decimal:2',
            'validity_days' => 'integer',
            'sent_email' => 'boolean',
            'sent_whatsapp' => 'boolean',
            'sent_sms' => 'boolean',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyProfile::class, 'company_profile_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class)->orderBy('position');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Recalculate subtotal / GST / grand total from the loaded items and persist.
     */
    public function recalcTotals(): void
    {
        $items = $this->relationLoaded('items') ? $this->items : $this->items()->get();
        $subtotal = 0.0;
        foreach ($items as $item) {
            $amount = round((float) $item->quantity * (float) $item->rate, 2);
            if ((float) $item->amount !== $amount) {
                $item->amount = $amount;
                $item->save();
            }
            $subtotal += $amount;
        }
        $gst = round($subtotal * ((float) $this->gst_percent / 100), 2);
        $grand = round($subtotal + $gst, 2);

        $this->subtotal = $subtotal;
        $this->gst_amount = $gst;
        $this->grand_total = $grand;
        $this->total_price = $grand; // backward-compat mirror
        $this->save();
    }
}
