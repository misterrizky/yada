<?php

namespace App\Models\QA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PM\Project;
use App\Models\PM\ProjectMilestone;
use App\Models\PM\Task;
use App\Models\User;

class QaReview extends Model
{
    use HasFactory, SoftDeletes;
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function milestone(): BelongsTo
    {
        return $this->belongsTo(ProjectMilestone::class, 'milestone_id');
    }

    public function qaChecklist(): BelongsTo
    {
        return $this->belongsTo(QaChecklist::class, 'qa_checklist_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function qaReviewItems(): HasMany
    {
        return $this->hasMany(QaReviewItem::class, 'qa_review_id');
    }

    public function qaIssues(): HasMany
    {
        return $this->hasMany(QaIssue::class, 'qa_review_id');
    }

    public function deliverySignoffs(): HasMany
    {
        return $this->hasMany(DeliverySignoff::class, 'qa_review_id');
    }
}
