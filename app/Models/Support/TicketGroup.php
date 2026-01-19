<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketGroup extends Model
{
    use HasFactory;
    public function groupTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'group_id');
    }

    public function assignedGroupTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'assigned_group_id');
    }

    public function cannedResponses(): HasMany
    {
        return $this->hasMany(CannedResponse::class, 'ticket_group_id');
    }
}
