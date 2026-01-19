<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolutionCategory extends Model
{
    use HasFactory, SoftDeletes;
    public function parent(): BelongsTo
    {
        return $this->belongsTo(SolutionCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(SolutionCategory::class, 'parent_id');
    }

    public function solutions(): HasMany
    {
        return $this->hasMany(Solution::class, 'category_id');
    }
}
