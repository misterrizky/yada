<?php

namespace App\Models\QA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliverySignoffItem extends Model
{
    use HasFactory;
    public function deliverySignoff(): BelongsTo
    {
        return $this->belongsTo(DeliverySignoff::class, 'delivery_signoff_id');
    }
}
