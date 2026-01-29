<?php

namespace App\Models\Master;

use App\Models\Concerns\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pipeline extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'flag',
    ];

    public function stages(): HasMany
    {
        return $this->hasMany(Stage::class, 'pipeline_id');
    }
}
