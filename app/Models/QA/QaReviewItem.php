<?php

namespace App\Models\QA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QaReviewItem extends Model
{
    use HasFactory;
    public function qaReview(): BelongsTo
    {
        return $this->belongsTo(QaReview::class, 'qa_review_id');
    }

    public function qaChecklistItem(): BelongsTo
    {
        return $this->belongsTo(QaChecklistItem::class, 'qa_checklist_item_id');
    }
}
