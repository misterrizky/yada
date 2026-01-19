<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Asset\Asset;
use App\Models\Asset\AssetMaintenance;
use App\Models\Regional\Currency;
use App\Models\User;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;
    public function category(): BelongsTo
    {
        return $this->belongsTo(VendorCategory::class, 'category_id');
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

    public function vendorContacts(): HasMany
    {
        return $this->hasMany(VendorContact::class, 'vendor_id');
    }

    public function vendorAddresses(): HasMany
    {
        return $this->hasMany(VendorAddress::class, 'vendor_id');
    }

    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class, 'vendor_id');
    }

    public function goodsReceipts(): HasMany
    {
        return $this->hasMany(GoodsReceipt::class, 'vendor_id');
    }

    public function vendorEvaluations(): HasMany
    {
        return $this->hasMany(VendorEvaluation::class, 'vendor_id');
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class, 'vendor_id');
    }

    public function assetMaintenances(): HasMany
    {
        return $this->hasMany(AssetMaintenance::class, 'vendor_id');
    }
}
