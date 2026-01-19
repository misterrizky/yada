<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Asset\InventoryItem;
use App\Models\Finance\CreditNoteItem;
use App\Models\Finance\InvoiceItem;
use App\Models\Procurement\PurchaseOrderItem;
use App\Models\Procurement\PurchaseRequestItem;
use App\Models\Sales\OrderItem;
use App\Models\Sales\ProposalItem;
use App\Models\Sales\QuotationItem;
use App\Models\User;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(ProductUnit::class, 'unit_id');
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
        return $this->hasMany(ProposalItem::class, 'product_id');
    }

    public function quotationItems(): HasMany
    {
        return $this->hasMany(QuotationItem::class, 'product_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class, 'product_id');
    }

    public function creditNoteItems(): HasMany
    {
        return $this->hasMany(CreditNoteItem::class, 'product_id');
    }

    public function purchaseRequestItems(): HasMany
    {
        return $this->hasMany(PurchaseRequestItem::class, 'product_id');
    }

    public function purchaseOrderItems(): HasMany
    {
        return $this->hasMany(PurchaseOrderItem::class, 'product_id');
    }

    public function inventoryItems(): HasMany
    {
        return $this->hasMany(InventoryItem::class, 'product_id');
    }
}
