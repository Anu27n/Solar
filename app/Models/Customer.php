<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    protected $fillable = [
        'channel_partner_id', 'user_id', 'name', 'phone', 'email', 'address',
        'city', 'state', 'installation_location', 'system_capacity_kw',
        'package_selected', 'installation_type', 'payment_method', 'status',
    ];

    public function channelPartner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'channel_partner_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kycDocuments(): HasMany
    {
        return $this->hasMany(CustomerKyc::class);
    }

    public function loan(): HasOne
    {
        return $this->hasOne(Loan::class);
    }

    public function installation(): HasOne
    {
        return $this->hasOne(Installation::class);
    }

    public function subsidy(): HasOne
    {
        return $this->hasOne(Subsidy::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(Commission::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'installation_completed' => 'success',
            'installation_rejected', 'kyc_rejected', 'loan_rejected' => 'danger',
            'kyc_approved', 'loan_approved' => 'info',
            default => 'warning',
        };
    }
}
