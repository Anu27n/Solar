<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commission extends Model
{
    protected $fillable = [
        'channel_partner_id', 'customer_id', 'amount', 'type',
        'status', 'period_month', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'period_month' => 'date',
        ];
    }

    public function channelPartner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'channel_partner_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
