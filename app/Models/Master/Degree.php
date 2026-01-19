<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User\UserEducation;

class Degree extends Model
{
    use HasFactory;
    public function userEducations(): HasMany
    {
        return $this->hasMany(UserEducation::class, 'degree_id');
    }
}
