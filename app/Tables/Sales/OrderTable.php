<?php

namespace App\Tables\Sales;

use App\Tables\Table;
use App\Tables\TableColumn;

final class OrderTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('order_number', 'Number')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('company.name', 'Company')
            )
            ->column(
                TableColumn::text('quotation.quotation_number', 'Quotation')
            )
            ->column(
                TableColumn::text('contract.contract_number', 'Contract')
            )
            ->column(
                TableColumn::text('order_date', 'Order Date')->sortable()
            )
            ->column(
                TableColumn::text('status', 'Status')->sortable()
            )
            ->column(
                TableColumn::text('total', 'Total')->sortable()
            )
            ->column(
                TableColumn::actions()
            )

            ->get();
    }
}
