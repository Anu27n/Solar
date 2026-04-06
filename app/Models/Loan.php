<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $fillable = [
        'customer_id', 'bank_name', 'down_payment', 'loan_amount',
        'emi_amount', 'total_emis', 'emis_paid', 'emis_pending', 'status', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'down_payment' => 'decimal:2',
            'loan_amount' => 'decimal:2',
            'emi_amount' => 'decimal:2',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
