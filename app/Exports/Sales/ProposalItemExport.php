<?php

namespace App\Exports\Sales;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProposalItemExport implements FromCollection, WithHeadings, WithMapping
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
            'Proposal',
            'Product',
            'Solution',
            'Item Name',
            'Quantity',
            'Unit',
            'Unit Price',
            'Discount',
            'Discount Type',
            'Tax Rate',
            'Amount',
            'Order',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->proposal?->proposal_number,
            $row->product?->name,
            $row->solution?->name,
            $row->item_name,
            $row->quantity,
            $row->unit,
            $row->unit_price,
            $row->discount,
            $row->discount_type,
            $row->tax_rate,
            $row->amount,
            $row->order,
        ];
    }
}
