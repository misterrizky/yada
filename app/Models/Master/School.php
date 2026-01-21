<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'degree_id',
        'code',
        'npsn',
        'state_id',
        'city_id',
        'subdistrict_id',
        'name',
        'address',
        'lat',
        'lng',
    ];
}
