<?php

namespace App\Models\PM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CRM\Company;
use App\Models\Finance\Budget;
use App\Models\Finance\Expense;
use App\Models\Finance\Invoice;
use App\Models\Finance\InvoiceRecurring;
use App\Models\Finance\Payment;
use App\Models\Procurement\PurchaseRequest;
use App\Models\QA\DeliverySignoff;
use App\Models\QA\QaChecklist;
use App\Models\QA\QaIssue;
use App\Models\QA\QaReview;
use App\Models\Regional\Currency;
use App\Models\Resource\ResourceAllocation;
use App\Models\Resource\ResourceRequest;
use App\Models\Resource\TeamComposition;
use App\Models\Sales\Contract;
use App\Models\Support\Ticket;
use App\Models\User;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function projectGalleries(): HasMany
    {
        return $this->hasMany(ProjectGallery::class, 'project_id');
    }

    public function projectMembers(): HasMany
    {
        return $this->hasMany(ProjectMember::class, 'project_id');
    }

    public function projectMilestones(): HasMany
    {
        return $this->hasMany(ProjectMilestone::class, 'project_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class, 'project_id');
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'project_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'project_id');
    }

    public function invoiceRecurrings(): HasMany
    {
        return $this->hasMany(InvoiceRecurring::class, 'project_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'project_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'project_id');
    }

    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'project_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'project_id');
    }

    public function resourceAllocations(): HasMany
    {
        return $this->hasMany(ResourceAllocation::class, 'project_id');
    }

    public function resourceRequests(): HasMany
    {
        return $this->hasMany(ResourceRequest::class, 'project_id');
    }

    public function teamCompositions(): HasMany
    {
        return $this->hasMany(TeamComposition::class, 'project_id');
    }

    public function purchaseRequests(): HasMany
    {
        return $this->hasMany(PurchaseRequest::class, 'project_id');
    }

    public function qaChecklists(): HasMany
    {
        return $this->hasMany(QaChecklist::class, 'project_id');
    }

    public function qaReviews(): HasMany
    {
        return $this->hasMany(QaReview::class, 'project_id');
    }

    public function qaIssues(): HasMany
    {
        return $this->hasMany(QaIssue::class, 'project_id');
    }

    public function deliverySignoffs(): HasMany
    {
        return $this->hasMany(DeliverySignoff::class, 'project_id');
    }
}
