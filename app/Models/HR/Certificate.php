<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User\UserCertificate;

class Certificate extends Model
{
    use HasFactory;
    public function userCertificates(): HasMany
    {
        return $this->hasMany(UserCertificate::class, 'certificate_id');
    }
}
