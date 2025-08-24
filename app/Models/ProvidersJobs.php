<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvidersJobs extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'user_id',
        'title',
        'description',
        'status',
        'meta'
    ];
    protected $casts = [
        'meta' => 'array',
        'status' => 'string',
    ];

    public function provider()
    {
        return $this->belongsTo(Providers::class, 'provider_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
