<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'available',
        'delta',
        'has_popularity',
    ];

    protected $casts = [
        'available' => 'boolean',
        'has_popularity' => 'boolean',
    ];
}
