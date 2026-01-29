<?php

namespace App\Models\Master;

use App\Models\Concerns\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stage extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'flag',
        'color',
        'order',
        'is_default',
        'probability',
        'is_won',
        'is_lost',
        'pipeline_id',
    ];

    public function pipeline(): BelongsTo
    {
        return $this->belongsTo(Pipeline::class, 'pipeline_id');
    }
}
