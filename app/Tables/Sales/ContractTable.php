<?php

namespace App\Tables\Sales;

use App\Tables\Table;
use App\Tables\TableColumn;

final class ContractTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('contract_number', 'Number')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('company.name', 'Company')
            )
            ->column(
                TableColumn::text('project.name', 'Project')
            )
            ->column(
                TableColumn::text('quotation.quotation_number', 'Quotation')
            )
            ->column(
                TableColumn::text('contractType.name', 'Type')
            )
            ->column(
                TableColumn::text('status', 'Status')->sortable()
            )
            ->column(
                TableColumn::text('contract_value', 'Value')->sortable()
            )
            ->column(
                TableColumn::actions()
            )

            ->get();
    }
}
