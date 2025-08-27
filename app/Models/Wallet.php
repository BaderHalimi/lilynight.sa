<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;


    protected $fillable = [
        'provider_id',
        'balance',
        'locked_balance',
        'Withdrawn',
        'meta',
    ];
    protected $casts = [
        'meta' => 'array',
    ];

    public function provider()
    {
        return $this->belongsTo(Providers::class);
    }
}
