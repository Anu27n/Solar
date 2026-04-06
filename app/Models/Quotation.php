<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quotation extends Model
{
    protected $fillable = [
        'customer_id', 'package_id', 'total_price', 'details',
        'sent_email', 'sent_whatsapp', 'sent_sms', 'created_by',
    ];

    protected function casts(): array
    {
        return [
            'total_price' => 'decimal:2',
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

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
