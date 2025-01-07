<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HappyEndings extends Model
{
    protected $fillable = [
        'pet_id',
        'images',
        'story',
        'location',
    ];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pets::class, 'pet_id');
    }
}
