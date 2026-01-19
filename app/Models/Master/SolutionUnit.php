<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SolutionUnit extends Model
{
    use HasFactory;
    public function solutions(): HasMany
    {
        return $this->hasMany(Solution::class, 'unit_id');
    }
}
