<?php

namespace App\Tables\Master;

use App\Tables\Table;
use App\Tables\TableColumn;

final class SourceTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('name', 'Name')->sortable()->searchable()
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
