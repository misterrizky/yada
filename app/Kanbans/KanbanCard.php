<?php

namespace App\Kanbans;

final class KanbanCard
{
    public function __construct(
        public string $id,
        public string $title,
        public ?string $subtitle = null,
        public array $badges = [],
        public array $meta = [],
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'badges' => $this->badges,
            'meta' => $this->meta,
        ];
    }
}
