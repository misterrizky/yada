<?php

namespace App\Models\CRM;

use App\Models\Concerns\Searchable;
use App\Models\Master\Industry;
use App\Models\Master\Stage;
use App\Models\Sales\Proposal;
use App\Models\Sales\Quotation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $fillable = [
        'ulid',
        'code',
        'name',
        'company_name',
        'email',
        'phone',
        'website',
        'address',
        'value',
        'notes',
        'source_id',
        'stage_id',
        'industry_id',
        'user_id',
        'company_id',
        'converted_at',
        'created_by',
        'updated_by',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class, 'source_id');
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }

    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function leadActivities(): HasMany
    {
        return $this->hasMany(LeadActivity::class, 'lead_id');
    }

    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class, 'lead_id');
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class, 'lead_id');
    }
}
