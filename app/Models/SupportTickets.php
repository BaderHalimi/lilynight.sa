<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTickets extends Model
{
    use HasFactory;
    protected $table = 'support_tickets';
    protected $fillable = [
        'user_id',
        'provider_id',
        'staff_id',
        'title',
        'description',
        'status',
        'meta',
    ];
    protected $casts = [
        'meta' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function provider()
    {
        return $this->belongsTo(Providers::class, 'provider_id');
    }
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

}
