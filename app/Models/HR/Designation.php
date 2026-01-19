<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Resource\ResourceRequest;

class Designation extends Model
{
    use HasFactory;
    public function designationFamily(): BelongsTo
    {
        return $this->belongsTo(DesignationFamily::class, 'designation_family_id');
    }

    public function jobLevel(): BelongsTo
    {
        return $this->belongsTo(JobLevel::class, 'job_level_id');
    }

    public function designationRatecards(): HasMany
    {
        return $this->hasMany(DesignationRatecard::class, 'designation_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'designation_id');
    }

    public function resourceRequests(): HasMany
    {
        return $this->hasMany(ResourceRequest::class, 'designation_id');
    }
}
