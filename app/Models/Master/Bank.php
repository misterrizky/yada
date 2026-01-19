<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Finance\BankAccount;
use App\Models\User\UserBank;

class Bank extends Model
{
    use HasFactory;
    public function userBanks(): HasMany
    {
        return $this->hasMany(UserBank::class, 'bank_id');
    }

    public function bankAccounts(): HasMany
    {
        return $this->hasMany(BankAccount::class, 'bank_id');
    }
}
