<?php

namespace App\Models\Sales;

use App\Models\Concerns\Searchable;
use App\Models\Master\Product;
use App\Models\Master\Solution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'order_id',
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
        'order_column',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
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
