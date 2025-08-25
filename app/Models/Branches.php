<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'provider_id',
        'moderator_name',
        'status',
        'services',
        'meta'
    ];
    protected $casts = [
        'services' => 'array',
        'meta' => 'array',
    ];
    public function provider()
    {
        return $this->belongsTo(Providers::class, 'provider_id');
    }
    
}
