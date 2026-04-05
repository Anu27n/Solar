<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'short_description',
        'price',
        'description',
        'image_url',
        'contact_info',
        'source_url',
        'scraped_at',
    ];

    protected $casts = [
        'scraped_at' => 'datetime',
    ];
}
