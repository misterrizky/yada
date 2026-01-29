<?php

namespace App\Models\Finance;

use App\Models\Concerns\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'rate',
        'is_default',
        'is_active',
    ];
}
