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
                TableColumn::text('code', 'Code')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('name', 'Name')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('name_native', 'Native Name')
            )
            ->column(
                TableColumn::text('dir', 'Dir')
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
