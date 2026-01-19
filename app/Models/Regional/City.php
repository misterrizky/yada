<?php

namespace App\Models\Regional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\CRM\ClientAddress;
use App\Models\HR\Employee;
use App\Models\Procurement\VendorAddress;
use App\Models\User\UserAddress;

class City extends Model
{
    use HasFactory;
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function subdistricts(): HasMany
    {
        return $this->hasMany(Subdistrict::class, 'city_id');
    }

    public function userAddresses(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'city_id');
    }

    public function clientAddresses(): HasMany
    {
        return $this->hasMany(ClientAddress::class, 'city_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'city_id');
    }

    public function vendorAddresses(): HasMany
    {
        return $this->hasMany(VendorAddress::class, 'city_id');
    }
}
