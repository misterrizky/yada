<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Finance\CreditNoteItem;
use App\Models\Finance\InvoiceItem;
use App\Models\Sales\OrderItem;
use App\Models\Sales\ProposalItem;
use App\Models\Sales\QuotationItem;
use App\Models\User;

class Solution extends Model
{
    use HasFactory, SoftDeletes;
    public function category(): BelongsTo
    {
        return $this->belongsTo(SolutionCategory::class, 'category_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(SolutionUnit::class, 'unit_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function proposalItems(): HasMany
    {
        return $this->hasMany(ProposalItem::class, 'solution_id');
    }

    public function quotationItems(): HasMany
    {
        return $this->hasMany(QuotationItem::class, 'solution_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'solution_id');
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class, 'solution_id');
    }

    public function creditNoteItems(): HasMany
    {
        return $this->hasMany(CreditNoteItem::class, 'solution_id');
    }
}
