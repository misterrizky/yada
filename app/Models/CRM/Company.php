<?php

namespace App\Models\CRM;

use App\Models\User;
use Spatie\Tags\HasTags;
use App\Models\PM\Project;
use App\Models\Sales\Order;
use App\Models\Sales\Contract;
use App\Models\Sales\Proposal;
use App\Models\Support\Ticket;
use App\Models\Finance\Expense;
use App\Models\Finance\Invoice;
use App\Models\Finance\Payment;
use App\Models\Master\Industry;
use App\Models\Sales\Quotation;
use App\Models\Regional\Currency;
use App\Models\Finance\CreditNote;
use Illuminate\Database\Eloquent\Model;
use App\Models\Finance\InvoiceRecurring;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory, HasTags, SoftDeletes;
    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function companyContacts(): HasMany
    {
        return $this->hasMany(CompanyContact::class, 'company_id');
    }

    public function companyAddresses(): HasMany
    {
        return $this->hasMany(CompanyAddress::class, 'company_id');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class, 'company_id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'company_id');
    }

    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class, 'company_id');
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class, 'company_id');
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'company_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'company_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'company_id');
    }

    public function invoiceRecurrings(): HasMany
    {
        return $this->hasMany(InvoiceRecurring::class, 'company_id');
    }

    public function creditNotes(): HasMany
    {
        return $this->hasMany(CreditNote::class, 'company_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'company_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'company_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'company_id');
    }
}
