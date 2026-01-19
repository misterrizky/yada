<?php

namespace App\Models\Regional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User\UserLanguage;

class Language extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function userLanguages(): HasMany
    {
        return $this->hasMany(UserLanguage::class, 'language_id');
    }
}
