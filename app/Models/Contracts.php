<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    use HasFactory;
        protected $table = 'contracts';

        protected $fillable = [
            'name',
            'date',
            'content',
            'status',
            'provider_signature',
            'customer_signature',
            'amount',
            'customer_id',
            'provider_id',
            'meta',
        ];

        protected $casts = [
            'date' => 'datetime',
            'amount' => 'decimal:2',
            'meta' => 'array',
        ];

        public function customer()
        {
            return $this->belongsTo(User::class, 'customer_id');
        }

        public function provider()
        {
            return $this->belongsTo(Providers::class, 'provider_id');
        }
}
