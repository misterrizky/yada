<?php

namespace App\Exports\Sales;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProposalExport implements FromCollection, WithHeadings, WithMapping
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
            'Proposal Number',
            'Title',
            'Lead',
            'Company',
            'Status',
            'Valid Until',
            'Currency',
            'Sub Total',
            'Discount',
            'Discount Type',
            'Tax',
            'Total',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->proposal_number,
            $row->title,
            $row->lead?->name,
            $row->company?->name,
            $row->status,
            $row->valid_until,
            $row->currency?->code,
            $row->sub_total,
            $row->discount,
            $row->discount_type,
            $row->tax,
            $row->total,
        ];
    }
}
