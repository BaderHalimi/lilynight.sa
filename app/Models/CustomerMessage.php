<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMessage extends Model
{
    use HasFactory;
    protected $table = 'customer_messages';
    protected $fillable = [
        'chat_id',
        'sender_id', 
        'message',
        'attachment',
        'meta',
    ];
    protected $casts = [
        'meta' => 'array',
    ];
    public function chat()
    {
        return $this->belongsTo(CustomerChats::class, 'chat_id');
    }

}
