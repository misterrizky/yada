<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CountryExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(public Collection $rows) {}

    public function collection()
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return [
            'ID', 'Name', 'ISO2', 'ISO3', 'Phone Code', 'Region', 'Subregion', 'Status',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $row->iso2,
            $row->iso3,
            $row->phone_code,
            $row->region,
            $row->subregion,
            $row->status,
        ];
    }
}
