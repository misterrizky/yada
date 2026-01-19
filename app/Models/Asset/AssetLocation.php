<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssetLocation extends Model
{
    use HasFactory;
    public function parent(): BelongsTo
    {
        return $this->belongsTo(AssetLocation::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(AssetLocation::class, 'parent_id');
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class, 'location_id');
    }
}
