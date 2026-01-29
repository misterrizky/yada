<?php

namespace App\Models\CRM;

use App\Models\Concerns\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostReason extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
    ];
}
