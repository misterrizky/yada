<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContractType extends Model
{
    use HasFactory;
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'contract_type_id');
    }
}
