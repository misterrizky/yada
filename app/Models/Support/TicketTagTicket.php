<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TicketTagTicket extends Pivot
{
    use HasFactory;
    protected $table = 'ticket_tag_ticket';

    public $incrementing = false;

    public $timestamps = false;

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function ticketTag(): BelongsTo
    {
        return $this->belongsTo(TicketTag::class, 'ticket_tag_id');
    }
}
