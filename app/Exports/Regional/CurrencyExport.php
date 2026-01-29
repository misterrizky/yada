<?php

namespace App\Exports\Regional;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CurrencyExport implements FromCollection, WithHeadings, WithMapping
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
            'Code',
            'Name',
            'Precision',
            'Symbol',
            'Symbol Native',
            'Symbol First',
            'Decimal Mark',
            'Thousands Separator',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->country_id,
            $row->code,
            $row->name,
            $row->precision,
            $row->symbol,
            $row->symbol_native,
            $row->symbol_first,
            $row->decimal_mark,
            $row->thousands_separator,
        ];
    }
}
