<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class ComplianceChecklist extends Model
{
    use HasFactory, SoftDeletes;
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function complianceChecklistItems(): HasMany
    {
        return $this->hasMany(ComplianceChecklistItem::class, 'compliance_checklist_id');
    }

    public function complianceReviews(): HasMany
    {
        return $this->hasMany(ComplianceReview::class, 'compliance_checklist_id');
    }
}
