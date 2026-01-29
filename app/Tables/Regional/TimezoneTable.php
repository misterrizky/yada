<?php

namespace App\Tables\Regional;

use App\Tables\Table;
use App\Tables\TableColumn;

final class TimezoneTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('name', 'name')->sortable()->searchable()
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
