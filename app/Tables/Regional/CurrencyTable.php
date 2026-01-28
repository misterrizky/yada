<?php

namespace App\Tables\Regional;

use App\Tables\Table;
use App\Tables\TableColumn;

final class CurrencyTable extends Table
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
                TableColumn::text('precision', 'Precision')
            )
            ->column(
                TableColumn::text('symbol', 'Symbol')
            )
            ->column(
                TableColumn::text('symbol_native', 'Symbol Native')
            )
            ->column(
                TableColumn::text('decimal_mark', 'Decimal Mark')
            )
            ->column(
                TableColumn::text('thousand_separator', 'Thousand Separator')
            )
            ->column(
                TableColumn::badge('symbol_first', 'Symbol First')
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
