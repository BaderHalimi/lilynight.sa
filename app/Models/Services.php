<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'price_unit',
        'type',
        'provider_id',
        'description',
        'service_location',
        'features',
        'meta',
    ];

    protected $casts = [
        'features' => 'array',
        'meta' => 'array',
    ];

    public function provider()
    {
        return $this->belongsTo(Providers::class);
    }
}
