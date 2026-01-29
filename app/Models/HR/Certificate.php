<?php

namespace App\Models\HR;

use App\Models\Concerns\Searchable;
use App\Models\User\UserCertificate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Certificate extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function userCertificates(): HasMany
    {
        return $this->hasMany(UserCertificate::class, 'certificate_id');
    }
}
