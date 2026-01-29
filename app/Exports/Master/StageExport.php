<?php

namespace App\Exports\Master;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StageExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(public Collection $rows) {}

    public function collection(): Collection
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Pipeline',
            'Name',
            'Flag',
            'Color',
            'Order',
            'Default',
            'Probability',
            'Won',
            'Lost',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->pipeline?->name,
            $row->name,
            $row->flag,
            $row->color,
            $row->order,
            $row->is_default,
            $row->probability,
            $row->is_won,
            $row->is_lost,
        ];
    }
}
