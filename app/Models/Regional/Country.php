<?php

namespace App\Models\Regional;

use App\Models\Concerns\Searchable;
use App\Models\CRM\CompanyAddress;
use App\Models\Procurement\VendorAddress;
use App\Models\User\UserAddress;
use App\Models\User\UserProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'iso2',
        'iso3',
        'name',
        'phone_code',
        'region',
        'subregion',
        'status',
    ];

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
        return $this->hasMany(CompanyAddress::class, 'country_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(UserProfile::class, 'country_id');
    }

    public function vendorAddresses(): HasMany
    {
        return $this->hasMany(VendorAddress::class, 'country_id');
    }
}
