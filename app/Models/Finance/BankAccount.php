<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\Bank;
use App\Models\Regional\Currency;

class BankAccount extends Model
{
    use HasFactory, SoftDeletes;
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'bank_account_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'bank_account_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'bank_account_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'bank_account_id');
    }
}
