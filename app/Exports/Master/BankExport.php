<?php

namespace App\Exports\Master;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BankExport implements FromCollection, WithHeadings, WithMapping
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
            'Swift Code',
            'Active',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->code,
            $row->name,
            $row->swift_code,
            $row->is_active,
        ];
    }
}
