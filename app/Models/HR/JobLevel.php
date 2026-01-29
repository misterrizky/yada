<?php

namespace App\Models\HR;

use App\Models\Concerns\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobLevel extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'multiplier',
    ];

    public function designations(): HasMany
    {
        return $this->hasMany(Designation::class, 'job_level_id');
    }
}
