<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name', 'system_size_kw', 'price', 'estimated_generation',
        'warranty_details', 'description', 'type', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'system_size_kw' => 'decimal:2',
            'price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }
}
