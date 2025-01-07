<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pets extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'sex',
        'age',
        'type',
        'size',
        'state',
        'godfather_id',
        'partner_id',
        'veterinary_id',
        'image'
    ];

    /**
     * Get the pet's partner.
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    /**
     * Get the pet's godfather.
     */
    public function godfather(): BelongsTo
    {
        return $this->belongsTo(User::class, 'godfather_id');
    }

    /**
     * Get the pet's veterinary.
     */
    public function veterinary(): BelongsTo
    {
        return $this->belongsTo(User::class, 'veterinary_id');
    }

    public function getStatus()
    {
        if ($this->godfather) {
            return 'Adoptado';
        }

        return 'En adopción';
    }
}
