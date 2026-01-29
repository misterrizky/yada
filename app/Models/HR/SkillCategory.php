<?php

namespace App\Models\HR;

use App\Models\Concerns\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillCategory extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'parent_id',
        'name',
        'is_active',
    ];

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class, 'skill_category_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
