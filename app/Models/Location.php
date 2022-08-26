<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'query',
        'status',
        'country',
        'regionName',
        'city',
        'lat',
        'lon',
        'timezone',
        'zip',
        'user_id'
    ];
}
