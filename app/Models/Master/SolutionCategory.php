<?php

namespace App\Models\Master;

use App\Models\Concerns\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolutionCategory extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $fillable = [
        'ulid',
        'name',
        'slug',
        'short_desc',
        'long_desc',
        'thumbnail',
        'parent_id',
        'order',
        'is_active',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function solutions(): HasMany
    {
        return $this->hasMany(Solution::class, 'category_id');
    }
}
