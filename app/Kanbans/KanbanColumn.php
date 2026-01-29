<?php

namespace App\Kanbans;

final class KanbanColumn
{
    public function __construct(
        public string $key,
        public string $title,
        public ?string $subheading = null,
        public array $cards = [],
    ) {}

    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'title' => $this->title,
            'subheading' => $this->subheading,
            'cards' => collect($this->cards)
                ->map(fn ($card) => $card instanceof KanbanCard ? $card->toArray() : $card)
                ->all(),
        ];
    }
}
