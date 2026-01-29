<?php

namespace App\Tables\Sales;

use App\Tables\Table;
use App\Tables\TableColumn;

final class ProductTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('sku', 'SKU')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('name', 'Name')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('category.name', 'Category')
            )
            ->column(
                TableColumn::text('unit.name', 'Unit')
            )
            ->column(
                TableColumn::text('selling_price', 'Selling Price')->sortable()
            )
            ->column(
                TableColumn::badge('is_sellable', 'Sellable')
            )
            ->column(
                TableColumn::badge('is_active', 'Status')
            )
            ->column(
                TableColumn::actions()
            )

            ->get();
    }
}
