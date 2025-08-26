<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'value',
        'meta',
    ];
    protected $casts = [
        'meta' => 'array',
    ];

    public static function currencies()
    {
        return self::where('key', 'currency')->get();
    }

}
