<?php

namespace App\Models\Sales;

use App\Models\Concerns\Searchable;
use App\Models\CRM\Company;
use App\Models\CRM\Lead;
use App\Models\Regional\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $fillable = [
        'ulid',
        'quotation_number',
        'lead_id',
        'company_id',
        'proposal_id',
        'title',
        'description',
        'valid_until',
        'status',
        'currency_id',
        'sub_total',
        'discount',
        'discount_type',
        'tax',
        'total',
        'terms_conditions',
        'notes',
        'approved_by',
        'approved_at',
        'sent_at',
        'accepted_at',
        'created_by',
        'updated_by',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function quotationItems(): HasMany
    {
        return $this->hasMany(QuotationItem::class, 'quotation_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'quotation_id');
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'quotation_id');
    }
}
