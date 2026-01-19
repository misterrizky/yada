<?php

namespace App\Models\PM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\QA\QaIssue;
use App\Models\QA\QaReview;
use App\Models\Resource\ResourceAllocation;
use App\Models\User;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function milestone(): BelongsTo
    {
        return $this->belongsTo(ProjectMilestone::class, 'milestone_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'parent_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

    public function taskUsers(): HasMany
    {
        return $this->hasMany(TaskUser::class, 'task_id');
    }

    public function taskLabelTasks(): HasMany
    {
        return $this->hasMany(TaskLabelTask::class, 'task_id');
    }

    public function taskComments(): HasMany
    {
        return $this->hasMany(TaskComment::class, 'task_id');
    }

    public function taskFiles(): HasMany
    {
        return $this->hasMany(TaskFile::class, 'task_id');
    }

    public function subTasks(): HasMany
    {
        return $this->hasMany(SubTask::class, 'task_id');
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class, 'task_id');
    }

    public function resourceAllocations(): HasMany
    {
        return $this->hasMany(ResourceAllocation::class, 'task_id');
    }

    public function qaReviews(): HasMany
    {
        return $this->hasMany(QaReview::class, 'task_id');
    }

    public function qaIssues(): HasMany
    {
        return $this->hasMany(QaIssue::class, 'task_id');
    }
}
