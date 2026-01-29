<?php

namespace App\Exports\CRM;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeadExport implements FromCollection, WithHeadings, WithMapping
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
            'Company Name',
            'Email',
            'Phone',
            'Website',
            'Address',
            'Value',
            'Notes',
            'Source',
            'Stage',
            'Industry',
            'Owner',
            'Company',
            'Converted At',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->code,
            $row->name,
            $row->company_name,
            $row->email,
            $row->phone,
            $row->website,
            $row->address,
            $row->value,
            $row->notes,
            $row->source?->name,
            $row->stage?->name,
            $row->industry?->name,
            $row->user?->name,
            $row->company?->name,
            $row->converted_at,
        ];
    }
}
