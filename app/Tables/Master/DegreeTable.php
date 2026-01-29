<?php

namespace App\Tables\Master;

use App\Tables\Table;
use App\Tables\TableColumn;

final class DegreeTable extends Table
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
                TableColumn::text('order', 'Order')->sortable()
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
