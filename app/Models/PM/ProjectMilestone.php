<?php

namespace App\Models\PM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\QA\DeliverySignoff;
use App\Models\QA\QaReview;
use App\Models\User;

class ProjectMilestone extends Model
{
    use HasFactory;
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'milestone_id');
    }

    public function qaReviews(): HasMany
    {
        return $this->hasMany(QaReview::class, 'milestone_id');
    }

    public function deliverySignoffs(): HasMany
    {
        return $this->hasMany(DeliverySignoff::class, 'milestone_id');
    }
}
