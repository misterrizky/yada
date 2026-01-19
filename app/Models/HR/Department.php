<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Finance\Budget;
use App\Models\Approval\ApprovalWorkflowStep;
use App\Models\Procurement\PurchaseRequest;
use App\Models\Resource\CapacityPlan;
use App\Models\User;

class Department extends Model
{
    use HasFactory, SoftDeletes;
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }

    public function head(): BelongsTo
    {
        return $this->belongsTo(User::class, 'head_id');
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
        return $this->hasMany(Department::class, 'parent_id');
    }

    public function designationFamilies(): HasMany
    {
        return $this->hasMany(DesignationFamily::class, 'department_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'department_id');
    }

    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'department_id');
    }

    public function capacityPlans(): HasMany
    {
        return $this->hasMany(CapacityPlan::class, 'department_id');
    }

    public function purchaseRequests(): HasMany
    {
        return $this->hasMany(PurchaseRequest::class, 'department_id');
    }

    public function approvalWorkflowSteps(): HasMany
    {
        return $this->hasMany(ApprovalWorkflowStep::class, 'approver_department_id');
    }
}
