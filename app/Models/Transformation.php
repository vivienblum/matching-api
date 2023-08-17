<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_id',
        'image_url',
        'pattern',
        'items',
    ];

    protected $casts = [
        'pattern' => 'json',
        'items' => 'json',
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }
}
