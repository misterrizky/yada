<?php

namespace App\Tables\Master;

use App\Tables\Table;
use App\Tables\TableColumn;

final class JobLevelTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('name', 'Name')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('slug', 'Slug')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('sort_order', 'Sort Order')->sortable()
            )
            ->column(
                TableColumn::text('multiplier', 'Multiplier')->sortable()
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
