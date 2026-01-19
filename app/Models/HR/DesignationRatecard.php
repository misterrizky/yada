<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DesignationRatecard extends Model
{
    use HasFactory;
    public function catalog(): BelongsTo
    {
        return $this->belongsTo(RatecardCatalog::class, 'catalog_id');
    }

    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}
