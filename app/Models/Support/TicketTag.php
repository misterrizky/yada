<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketTag extends Model
{
    use HasFactory;
    public function ticketTagTickets(): HasMany
    {
        return $this->hasMany(TicketTagTicket::class, 'ticket_tag_id');
    }
}
