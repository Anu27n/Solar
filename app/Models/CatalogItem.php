<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogItem extends Model
{
    protected $fillable = [
        'company_profile_id',
        'name',
        'description',
        'sku',
        'unit',
        'list_price',
        'stock_quantity',
        'is_published',
        'position',
    ];

    protected function casts(): array
    {
        return [
            'list_price' => 'decimal:2',
            'stock_quantity' => 'integer',
            'is_published' => 'boolean',
            'position' => 'integer',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyProfile::class, 'company_profile_id');
    }
}
