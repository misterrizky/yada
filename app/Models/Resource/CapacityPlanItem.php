<?php

namespace App\Models\Resource;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CapacityPlanItem extends Model
{
    use HasFactory;

    public function capacityPlan(): BelongsTo
    {
        return $this->belongsTo(CapacityPlan::class, 'capacity_plan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
