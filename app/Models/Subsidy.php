<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subsidy extends Model
{
    protected $fillable = [
        'customer_id', 'subsidy_amount', 'status', 'status_check_link',
        'application_number', 'notes',
    ];

    protected function casts(): array
    {
        return ['subsidy_amount' => 'decimal:2'];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
