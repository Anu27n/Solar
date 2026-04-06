<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerKyc extends Model
{
    protected $table = 'customer_kyc';

    protected $fillable = [
        'customer_id', 'document_type', 'file_path', 'original_filename',
        'status', 'rejection_reason', 'reviewed_by', 'reviewed_at',
    ];

    protected function casts(): array
    {
        return ['reviewed_at' => 'datetime'];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function getDocumentLabelAttribute(): string
    {
        return match ($this->document_type) {
            'aadhaar_card' => 'Aadhaar Card',
            'pan_card' => 'PAN Card',
            'address_proof' => 'Address Proof',
            'electricity_bill' => 'Electricity Bill',
            'property_ownership' => 'Property Ownership',
            'bank_details' => 'Bank Details',
            default => $this->document_type,
        };
    }
}
