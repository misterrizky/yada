<?php

namespace App\Tables\Sales;

use App\Tables\Table;
use App\Tables\TableColumn;

final class QuotationItemTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('item_name', 'Item')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('product.name', 'Product')
            )
            ->column(
                TableColumn::text('solution.name', 'Solution')
            )
            ->column(
                TableColumn::text('quantity', 'Qty')
            )
            ->column(
                TableColumn::text('unit_price', 'Unit Price')
            )
            ->column(
                TableColumn::text('amount', 'Amount')
            )
            ->column(
                TableColumn::actions()
            )

            ->get();
    }
}
