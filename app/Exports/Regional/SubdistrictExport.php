<?php

namespace App\Exports\Regional;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SubdistrictExport implements FromCollection, WithHeadings, WithMapping
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
            'City ID',
            'Code',
            'Full Code',
            'Name',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->city_id,
            $row->code,
            $row->full_code,
            $row->name,
        ];
    }
}
