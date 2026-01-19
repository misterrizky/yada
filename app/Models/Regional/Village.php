<?php

namespace App\Models\Regional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User\UserAddress;

class Village extends Model
{
    use HasFactory;
    public function subdistrict(): BelongsTo
    {
        return $this->belongsTo(Subdistrict::class, 'subdistrict_id');
    }

    public function userAddresses(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'village_id');
    }
}
