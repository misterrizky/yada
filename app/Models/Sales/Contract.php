<?php

namespace App\Models\Sales;

use App\Models\Concerns\Searchable;
use App\Models\CRM\Company;
use App\Models\PM\Project;
use App\Models\Regional\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $fillable = [
        'ulid',
        'contract_number',
        'company_id',
        'project_id',
        'quotation_id',
        'contract_type_id',
        'subject',
        'description',
        'start_date',
        'end_date',
        'currency_id',
        'contract_value',
        'status',
        'terms_conditions',
        'notes',
        'signed_by_company',
        'company_signed_at',
        'signed_by_internal',
        'internal_signed_at',
        'approved_by',
        'approved_at',
        'created_by',
        'updated_by',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }

    public function contractType(): BelongsTo
    {
        return $this->belongsTo(ContractType::class, 'contract_type_id');
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
}
