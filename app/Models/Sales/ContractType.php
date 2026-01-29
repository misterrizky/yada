<?php

namespace App\Models\Sales;

use App\Models\Concerns\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContractType extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'contract_type_id');
    }
}
