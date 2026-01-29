<?php

namespace App\Exports\Sales;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection, WithHeadings, WithMapping
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
            'SKU',
            'Name',
            'Category',
            'Unit',
            'Purchase Price',
            'Selling Price',
            'Tax Rate',
            'Purchasable',
            'Sellable',
            'Active',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->sku,
            $row->name,
            $row->category?->name,
            $row->unit?->name,
            $row->purchase_price,
            $row->selling_price,
            $row->tax_rate,
            $row->is_purchasable,
            $row->is_sellable,
            $row->is_active,
        ];
    }
}
