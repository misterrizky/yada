<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CRM\Company;
use App\Models\PM\Project;
use App\Models\User;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(TicketGroup::class, 'group_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TicketType::class, 'type_id');
    }

    public function channel(): BelongsTo
    {
        return $this->belongsTo(TicketChannel::class, 'channel_id');
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(TicketPriority::class, 'priority_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'status_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function slaPolicy(): BelongsTo
    {
        return $this->belongsTo(SlaPolicy::class, 'sla_policy_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedGroup(): BelongsTo
    {
        return $this->belongsTo(TicketGroup::class, 'assigned_group_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function ticketReplies(): HasMany
    {
        return $this->hasMany(TicketReply::class, 'ticket_id');
    }

    public function ticketFiles(): HasMany
    {
        return $this->hasMany(TicketFile::class, 'ticket_id');
    }

    public function ticketAgentAssignments(): HasMany
    {
        return $this->hasMany(TicketAgentAssignment::class, 'ticket_id');
    }

    public function ticketTagTickets(): HasMany
    {
        return $this->hasMany(TicketTagTicket::class, 'ticket_id');
    }
}
