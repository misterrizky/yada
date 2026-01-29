<?php

namespace App\Exports\Project;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SolutionExport implements FromCollection, WithHeadings, WithMapping
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
            'Code',
            'Name',
            'Category',
            'Unit',
            'Hourly Rate',
            'Daily Rate',
            'Fixed Price',
            'Tax Rate',
            'Active',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->code,
            $row->name,
            $row->category?->name,
            $row->unit?->name,
            $row->hourly_rate,
            $row->daily_rate,
            $row->fixed_price,
            $row->tax_rate,
            $row->is_active,
        ];
    }
}
