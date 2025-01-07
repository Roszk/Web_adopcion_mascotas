<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = [
        'name',
        'date',
        'user_name',
        'user_phone',
        'location',
        'description',
    ];
}
