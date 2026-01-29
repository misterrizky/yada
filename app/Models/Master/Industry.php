<?php

namespace App\Models\Master;

use App\Models\Concerns\Searchable;
use App\Models\CRM\Company;
use App\Models\CRM\Lead;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Industry extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'is_active',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'industry_id');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class, 'industry_id');
    }
}
