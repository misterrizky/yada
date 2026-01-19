<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComplianceReviewItem extends Model
{
    use HasFactory;
    public function complianceReview(): BelongsTo
    {
        return $this->belongsTo(ComplianceReview::class, 'compliance_review_id');
    }

    public function complianceChecklistItem(): BelongsTo
    {
        return $this->belongsTo(ComplianceChecklistItem::class, 'compliance_checklist_item_id');
    }
}
