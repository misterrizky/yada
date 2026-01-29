<?php

namespace App\Models\HR;

use App\Models\Concerns\Searchable;
use App\Models\Resource\ResourceRequest;
use App\Models\Resource\ResourceSkill;
use App\Models\User\UserSkill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'skill_category_id',
        'name',
        'is_active',
    ];

    public function skillCategory(): BelongsTo
    {
        return $this->belongsTo(SkillCategory::class, 'skill_category_id');
    }

    public function userSkills(): HasMany
    {
        return $this->hasMany(UserSkill::class, 'skill_id');
    }

    public function resourceSkills(): HasMany
    {
        return $this->hasMany(ResourceSkill::class, 'skill_id');
    }

    public function resourceRequests(): HasMany
    {
        return $this->hasMany(ResourceRequest::class, 'skill_id');
    }
}
