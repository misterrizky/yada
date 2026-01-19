<?php

namespace App\Models\QA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QaChecklistItem extends Model
{
    use HasFactory;
    public function qaChecklist(): BelongsTo
    {
        return $this->belongsTo(QaChecklist::class, 'qa_checklist_id');
    }

    public function qaReviewItems(): HasMany
    {
        return $this->hasMany(QaReviewItem::class, 'qa_checklist_item_id');
    }
}
