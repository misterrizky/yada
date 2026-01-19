<?php

namespace App\Models\Resource;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamCompositionMember extends Model
{
    use HasFactory;

    public function teamComposition(): BelongsTo
    {
        return $this->belongsTo(TeamComposition::class, 'team_composition_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
