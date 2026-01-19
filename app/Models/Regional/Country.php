<?php

namespace App\Models\Regional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\CRM\ClientAddress;
use App\Models\HR\Employee;
use App\Models\Procurement\VendorAddress;
use App\Models\User\UserAddress;

class Country extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function states(): HasMany
    {
        return $this->hasMany(State::class, 'country_id');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'country_id');
    }

    public function currencies(): HasMany
    {
        return $this->hasMany(Currency::class, 'country_id');
    }

    public function timezones(): HasMany
    {
        return $this->hasMany(Timezone::class, 'country_id');
    }

    public function userAddresses(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'country_id');
    }

    public function clientAddresses(): HasMany
    {
        return $this->hasMany(ClientAddress::class, 'country_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'country_id');
    }

    public function vendorAddresses(): HasMany
    {
        return $this->hasMany(VendorAddress::class, 'country_id');
    }
}
