<?php

namespace App\Tables\Master;

use App\Tables\Table;
use App\Tables\TableColumn;

final class StageTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('pipeline.name', 'Pipeline')
            )
            ->column(
                TableColumn::text('name', 'Name')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('flag', 'Flag')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('color', 'Color')
            )
            ->column(
                TableColumn::text('order', 'Order')->sortable()
            )
            ->column(
                TableColumn::text('is_default', 'Default')
            )
            ->column(
                TableColumn::text('probability', 'Probability')
            )
            ->column(
                TableColumn::text('is_won', 'Won')
            )
            ->column(
                TableColumn::text('is_lost', 'Lost')
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
