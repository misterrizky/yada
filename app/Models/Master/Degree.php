<?php

namespace App\Models\Master;

use App\Models\Concerns\Searchable;
use App\Models\User\UserEducation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Degree extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'code',
        'name',
        'order',
    ];

    public function userEducations(): HasMany
    {
        return $this->hasMany(UserEducation::class, 'degree_id');
    }
}
