<?php

namespace App\Models\Regional;

use App\Models\PM\Project;
use App\Models\CRM\Company;
use App\Models\Sales\Order;
use App\Models\Finance\Budget;
use App\Models\Sales\Contract;
use App\Models\Sales\Proposal;
use App\Models\Finance\Expense;
use App\Models\Finance\Invoice;
use App\Models\Finance\Payment;
use App\Models\Sales\Quotation;
use App\Models\Finance\CreditNote;
use App\Models\Procurement\Vendor;
use App\Models\Concerns\Searchable;
use App\Models\Finance\BankAccount;
use App\Models\Finance\Transaction;
use App\Models\Finance\ExpenseClaim;
use Illuminate\Database\Eloquent\Model;
use App\Models\Finance\InvoiceRecurring;
use App\Models\Procurement\PurchaseOrder;
use App\Models\Procurement\PurchaseRequest;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory, Searchable;
    protected $fillable = [
        'country_id',
        'name',
        'code',
        'precision',
        'symbol',
        'symbol_native',
        'symbol_first',
        'decimal_mark',
        'thousand_separator',
    ];
    public $timestamps = false;

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'currency_id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'currency_id');
    }

    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class, 'currency_id');
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class, 'currency_id');
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'currency_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'currency_id');
    }

    public function bankAccounts(): HasMany
    {
        return $this->hasMany(BankAccount::class, 'currency_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'currency_id');
    }

    public function invoiceRecurrings(): HasMany
    {
        return $this->hasMany(InvoiceRecurring::class, 'currency_id');
    }

    public function creditNotes(): HasMany
    {
        return $this->hasMany(CreditNote::class, 'currency_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'currency_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'currency_id');
    }

    public function expenseClaims(): HasMany
    {
        return $this->hasMany(ExpenseClaim::class, 'currency_id');
    }

    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'currency_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'currency_id');
    }

    public function vendors(): HasMany
    {
        return $this->hasMany(Vendor::class, 'currency_id');
    }

    public function purchaseRequests(): HasMany
    {
        return $this->hasMany(PurchaseRequest::class, 'currency_id');
    }

    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class, 'currency_id');
    }
}
