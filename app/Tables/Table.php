<?php

namespace App\Tables;

abstract class Table
{
    protected array $columns = [];

    protected function add(TableColumn $column): static
    {
        $this->columns[] = $column;
        return $this;
    }

    /* ========= Column builders ========= */

    protected function text(string $field, string $label): TableColumn
    {
        return TableColumn::text($field, $label);
    }

    protected function badge(string $field, string $label): TableColumn
    {
        return TableColumn::badge($field, $label);
    }

    protected function actions(string $label = 'Action'): TableColumn
    {
        return TableColumn::actions($label);
    }

    /* ========= Finalize ========= */

    public function column(TableColumn $column): static
    {
        return $this->add($column);
    }

    public function get(): array
    {
        return $this->columns;
    }

    public function searchableFields(): array
    {
        return collect($this->columns)
            ->filter(fn (TableColumn $col) => $col->searchable)
            ->pluck('field')
            ->all();
    }
}
