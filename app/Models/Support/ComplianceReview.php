<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class ComplianceReview extends Model
{
    use HasFactory, SoftDeletes;
    public function complianceChecklist(): BelongsTo
    {
        return $this->belongsTo(ComplianceChecklist::class, 'compliance_checklist_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function complianceReviewItems(): HasMany
    {
        return $this->hasMany(ComplianceReviewItem::class, 'compliance_review_id');
    }
}
