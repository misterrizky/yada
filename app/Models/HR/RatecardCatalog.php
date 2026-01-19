<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RatecardCatalog extends Model
{
    use HasFactory;
    public function designationRatecards(): HasMany
    {
        return $this->hasMany(DesignationRatecard::class, 'catalog_id');
    }
}
