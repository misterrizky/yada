<?php

namespace App\Exports\Regional;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CityExport implements FromCollection, WithHeadings, WithMapping
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
            'Country ID',
            'State ID',
            'Country Code',
            'Code',
            'Name',
            'Type',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->country_id,
            $row->state_id,
            $row->country_code,
            $row->code,
            $row->name,
            $row->type,
        ];
    }
}
