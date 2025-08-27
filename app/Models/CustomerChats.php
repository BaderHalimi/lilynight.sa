<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerChats extends Model
{
    use HasFactory;
    protected $table = 'customer_chats';
    protected $fillable = [
        'customer_id',
        'provider_id',
        'Description',
        'subject',
        'image',
        'status',
        'meta',
    ];
    protected $casts = [
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
