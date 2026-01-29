<?php

namespace App\Exports\Sales;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderExport implements FromCollection, WithHeadings, WithMapping
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
            'Order Number',
            'Company',
            'Quotation',
            'Contract',
            'Order Date',
            'Expected Delivery Date',
            'Currency',
            'Sub Total',
            'Discount',
            'Discount Type',
            'Tax',
            'Total',
            'Status',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->order_number,
            $row->company?->name,
            $row->quotation?->quotation_number,
            $row->contract?->contract_number,
            $row->order_date,
            $row->expected_delivery_date,
            $row->currency?->code,
            $row->sub_total,
            $row->discount,
            $row->discount_type,
            $row->tax,
            $row->total,
            $row->status,
        ];
    }
}
