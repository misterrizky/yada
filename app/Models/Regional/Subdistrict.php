<?php

namespace App\Models\Regional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User\UserAddress;

class Subdistrict extends Model
{
    use HasFactory;
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function villages(): HasMany
    {
        return $this->hasMany(Village::class, 'subdistrict_id');
    }

    public function userAddresses(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'subdistrict_id');
    }
}
