<?php

namespace App\Exports\Regional;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VillageExport implements FromCollection, WithHeadings, WithMapping
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
            'Subdistrict ID',
            'Code',
            'Full Code',
            'Name',
            'Poscode',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->subdistrict_id,
            $row->code,
            $row->full_code,
            $row->name,
            $row->poscode,
        ];
    }
}
