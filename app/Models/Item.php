<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'collection_id',
        'image_url',
        'popularity',
        'a_red',
        'a_green',
        'a_blue',
        'd_red',
        'd_green',
        'd_blue',
        'ab_red',
        'ab_green',
        'ab_blue',
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }
}
