<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\HR\Employee;
use App\Models\PM\Project;
use App\Models\User;

class TeamComposition extends Model
{
    use HasFactory, SoftDeletes;
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function teamLead(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'team_lead_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function teamCompositionMembers(): HasMany
    {
        return $this->hasMany(TeamCompositionMember::class, 'team_composition_id');
    }
}
