<?php

namespace App\Tables;
use Livewire\Wireable;

final class TableColumn implements Wireable
{
    public function __construct(
        public readonly string $type,
        public readonly ?string $field,
        public readonly string $label,
        public readonly bool $sortable = false,
        public readonly bool $searchable = false,
        public readonly bool $toggleable = false,
    ) {}

    /* ========= Factory Methods ========= */

    public static function text(string $field, string $label): self
    {
        return new self(
            type: 'text',
            field: $field,
            label: $label
        );
    }

    public static function badge(string $field, string $label): self
    {
        return new self(
            type: 'badge',
            field: $field,
            label: $label
        );
    }

    public static function actions(string $label = 'Action'): self
    {
        return new self(
            type: 'action',
            field: null,
            label: $label
        );
    }

    /* ========= Modifiers ========= */

    public function sortable(): self
    {
        return new self(
            $this->type,
            $this->field,
            $this->label,
            sortable: true,
            searchable: $this->searchable,
            toggleable: $this->toggleable
        );
    }

    public function searchable(): self
    {
        return new self(
            $this->type,
            $this->field,
            $this->label,
            sortable: $this->sortable,
            searchable: true,
            toggleable: $this->toggleable
        );
    }
    public function toggleable(): self
    {
        return new self(
            $this->type,
            $this->field,
            $this->label,
            sortable: $this->sortable,
            searchable: $this->searchable,
            toggleable: true,
        );
    }

    /* ========= Helpers ========= */

    public function isAction(): bool
    {
        return $this->type === 'action';
    }
    public function toLivewire(): array
    {
        return [
            'type' => $this->type,
            'field' => $this->field,
            'label' => $this->label,
            'sortable' => $this->sortable,
            'searchable' => $this->searchable,
            'toggleable' => $this->toggleable
        ];
    }

    public static function fromLivewire($value): self
    {
        return new self(
            type: $value['type'],
            field: $value['field'],
            label: $value['label'],
            sortable: $value['sortable'],
            searchable: $value['searchable'],
            toggleable: $value['toggleable']
        );
    }
    public function render($row)
    {
        return match ($this->type) {
            'text' => data_get($row, $this->field),

            'badge' => view('components.app.data-table.badge', [
                'value' => data_get($row, $this->field),
            ]),

            default => null,
        };
    }
}
