<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class UserType extends Model
{
    use HasFactory;
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_type_id');
    }
}
