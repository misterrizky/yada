<?php

namespace App\Kanbans\CRM;

use App\Kanbans\Kanban;
use App\Kanbans\KanbanCard;
use App\Kanbans\KanbanColumn;
use App\Models\CRM\Lead;
use App\Models\Master\Stage;

final class LeadKanban
{
    public function __construct(public int $cardLimit = 20) {}

    public function columns(?string $search = null): array
    {
        $columns = [];

        $stages = Stage::query()
            ->orderBy('order')
            ->get(['id', 'name']);

        foreach ($stages as $stage) {
            $cards = $this->leadQuery($search)
                ->where('stage_id', $stage->id)
                ->limit($this->cardLimit)
                ->get()
                ->map(fn (Lead $lead) => $this->toCard($lead))
                ->all();

            $columns[] = new KanbanColumn(
                key: (string) $stage->id,
                title: $stage->name,
                subheading: null,
                cards: $cards,
            );
        }

        $unassigned = $this->leadQuery($search)
            ->whereNull('stage_id')
            ->limit($this->cardLimit)
            ->get()
            ->map(fn (Lead $lead) => $this->toCard($lead))
            ->all();

        if ($unassigned !== []) {
            $columns[] = new KanbanColumn(
                key: 'unassigned',
                title: 'Unassigned',
                subheading: null,
                cards: $unassigned,
            );
        }

        return (new Kanban($columns))->toArray();
    }

    private function leadQuery(?string $search)
    {
        $query = Lead::query()
            ->with(['source', 'industry', 'company', 'user'])
            ->latest();

        if (filled($search)) {
            $query->search($search, [
                'name',
                'company_name',
                'email',
                'phone',
                'code',
            ]);
        }

        return $query;
    }

    private function toCard(Lead $lead): KanbanCard
    {
        $badges = [];

        if ($lead->source) {
            $badges[] = ['label' => $lead->source->name, 'color' => 'sky'];
        }

        if ($lead->industry) {
            $badges[] = ['label' => $lead->industry->name, 'color' => 'emerald'];
        }

        $subtitle = $lead->company_name ?: $lead->company?->name;

        return new KanbanCard(
            id: (string) $lead->id,
            title: $lead->name,
            subtitle: $subtitle,
            badges: $badges,
            meta: [
                'value' => $lead->value,
                'owner' => $lead->user?->name,
            ],
        );
    }
}
