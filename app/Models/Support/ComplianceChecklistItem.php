<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ComplianceChecklistItem extends Model
{
    use HasFactory;
    public function complianceChecklist(): BelongsTo
    {
        return $this->belongsTo(ComplianceChecklist::class, 'compliance_checklist_id');
    }

    public function complianceReviewItems(): HasMany
    {
        return $this->hasMany(ComplianceReviewItem::class, 'compliance_checklist_item_id');
    }
}
