<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\HR\Employee;

class BloodType extends Model
{
    use HasFactory;
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'blood_type_id');
    }
}
