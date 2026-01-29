<?php

namespace App\Models\Master;

use App\Models\Concerns\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SolutionUnit extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'ulid',
        'code',
        'name',
        'is_active',
    ];

    public function solutions(): HasMany
    {
        return $this->hasMany(Solution::class, 'unit_id');
    }
}
