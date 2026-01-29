<?php

namespace App\Tables\CRM;

use App\Tables\Table;
use App\Tables\TableColumn;

final class CompanyTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('name', 'Name')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('code', 'Code')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('industry.name', 'Industry')
            )
            ->column(
                TableColumn::text('currency.code', 'Currency')
            )
            ->column(
                TableColumn::text('source.name', 'Source')
            )
            ->column(
                TableColumn::text('accountManager.name', 'Account Manager')
            )
            ->column(
                TableColumn::badge('status', 'Status')->sortable()
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
