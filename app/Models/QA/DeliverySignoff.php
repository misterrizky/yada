<?php

namespace App\Models\QA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PM\Project;
use App\Models\PM\ProjectMilestone;
use App\Models\Sales\Contract;
use App\Models\User;

class DeliverySignoff extends Model
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

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function qaReview(): BelongsTo
    {
        return $this->belongsTo(QaReview::class, 'qa_review_id');
    }

    public function pmSignoffBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pm_signoff_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deliverySignoffItems(): HasMany
    {
        return $this->hasMany(DeliverySignoffItem::class, 'delivery_signoff_id');
    }
}
