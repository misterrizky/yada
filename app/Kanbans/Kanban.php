<?php

namespace App\Kanbans;

final class Kanban
{
    public function __construct(public array $columns = []) {}

    public function toArray(): array
    {
        return collect($this->columns)
            ->map(fn ($column) => $column instanceof KanbanColumn ? $column->toArray() : $column)
            ->all();
    }
}
