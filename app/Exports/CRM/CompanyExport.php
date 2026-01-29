<?php

namespace App\Exports\CRM;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CompanyExport implements FromCollection, WithHeadings, WithMapping
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
            'Email',
            'Phone',
            'Website',
            'Procurement Email',
            'Procurement Phone',
            'Procurement Website',
            'Tax Number',
            'Status',
            'Industry',
            'Currency',
            'Source',
            'Account Manager',
            'Notes',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->code,
            $row->name,
            $row->email,
            $row->phone,
            $row->website,
            $row->email_procurement,
            $row->phone_procurement,
            $row->website_procurement,
            $row->tax_number,
            $row->status,
            $row->industry?->name,
            $row->currency?->code,
            $row->source?->name,
            $row->accountManager?->name,
            $row->notes,
        ];
    }
}
