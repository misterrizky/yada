<?php

namespace App\Models\Regional;

use App\Models\Concerns\Searchable;
use App\Models\User\UserLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    use HasFactory, Searchable;

    public $timestamps = false;

    public function userLanguages(): HasMany
    {
        return $this->hasMany(UserLanguage::class, 'language_id');
    }
}
