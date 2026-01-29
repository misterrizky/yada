<?php

namespace App\Exports\Sales;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContractExport implements FromCollection, WithHeadings, WithMapping
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
            'Contract Number',
            'Company',
            'Project',
            'Quotation',
            'Contract Type',
            'Subject',
            'Start Date',
            'End Date',
            'Currency',
            'Contract Value',
            'Status',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->contract_number,
            $row->company?->name,
            $row->project?->name,
            $row->quotation?->quotation_number,
            $row->contractType?->name,
            $row->subject,
            $row->start_date,
            $row->end_date,
            $row->currency?->code,
            $row->contract_value,
            $row->status,
        ];
    }
}
