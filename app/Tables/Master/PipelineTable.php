<?php

namespace App\Tables\Master;

use App\Tables\Table;
use App\Tables\TableColumn;

final class PipelineTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('name', 'Name')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('flag', 'Flag')->sortable()->searchable()
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
