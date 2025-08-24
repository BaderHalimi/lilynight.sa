<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_id',
        'slug',
        'name',
        'description',
        'logo',
        'type',
        'cr_number',
        'website',
        'email',
        'phone',
        'address',
        'city',
        'status',
        'meta'
    ];
    protected $casts = [
        'meta' => 'array',
        'status' => 'string',
    ];

    public function jobs()
    {
        return $this->hasMany(ProvidersJobs::class, 'provider_id');
    }
}
