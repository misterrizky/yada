<?php

namespace App\Exports\Project;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SolutionUnitExport implements FromCollection, WithHeadings, WithMapping
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
            'Active',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->code,
            $row->name,
            $row->is_active,
        ];
    }
}
