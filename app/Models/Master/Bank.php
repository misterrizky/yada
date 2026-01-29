<?php

namespace App\Models\Master;

use App\Models\Concerns\Searchable;
use App\Models\Finance\BankAccount;
use App\Models\User\UserBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bank extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'code',
        'name',
        'swift_code',
        'is_active',
    ];

    public function userBanks(): HasMany
    {
        return $this->hasMany(UserBank::class, 'bank_id');
    }

    public function bankAccounts(): HasMany
    {
        return $this->hasMany(BankAccount::class, 'bank_id');
    }
}
