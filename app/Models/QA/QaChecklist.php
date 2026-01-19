<?php

namespace App\Models\QA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PM\Project;
use App\Models\User;

class QaChecklist extends Model
{
    use HasFactory, SoftDeletes;
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function qaChecklistItems(): HasMany
    {
        return $this->hasMany(QaChecklistItem::class, 'qa_checklist_id');
    }

    public function qaReviews(): HasMany
    {
        return $this->hasMany(QaReview::class, 'qa_checklist_id');
    }
}
