<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\CRM\Company;
use App\Models\CRM\Lead;

class Industry extends Model
{
    use HasFactory;
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'industry_id');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class, 'industry_id');
    }
}
