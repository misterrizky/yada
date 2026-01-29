<?php

namespace App\Models\Sales;

use App\Models\Concerns\Searchable;
use App\Models\Master\Product;
use App\Models\Master\Solution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuotationItem extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'quotation_id',
        'product_id',
        'solution_id',
        'item_name',
        'description',
        'quantity',
        'unit',
        'unit_price',
        'discount',
        'discount_type',
        'tax_rate',
        'amount',
        'order',
    ];

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function solution(): BelongsTo
    {
        return $this->belongsTo(Solution::class, 'solution_id');
    }
}
