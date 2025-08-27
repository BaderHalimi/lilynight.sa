<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractTemplates extends Model
{
    use HasFactory;
    protected $table = 'contract_templates';
    protected $fillable = [
        'name',
        'content',
        "provider_id",
        'meta',
    ];
    protected $casts = [
        'meta' => 'array',
    ];
    public function provider()
    {
        return $this->belongsTo(Providers::class, 'provider_id');
    }

}
