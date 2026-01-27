<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserFilter extends Model
{
    protected $fillable = ['user_id', 'key', 'value'];

    protected $casts = [
        'value' => 'array',
    ];
}
