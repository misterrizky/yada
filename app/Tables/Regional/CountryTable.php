<?php

namespace App\Tables\Regional;

use App\Tables\Table;
use App\Tables\TableColumn;

final class CountryTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('iso2', 'Code')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('name', 'Name')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('phone_code', 'Phone Code')->sortable()
            )
            ->column(
                TableColumn::text('region', 'Region')
            )
            ->column(
                TableColumn::text('subregion', 'Subregion')
            )
            ->column(
                TableColumn::badge('status', 'Status')
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
