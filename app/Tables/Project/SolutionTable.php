<?php

namespace App\Tables\Project;

use App\Tables\Table;
use App\Tables\TableColumn;

final class SolutionTable extends Table
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
                TableColumn::text('category.name', 'Category')
            )
            ->column(
                TableColumn::text('unit.name', 'Unit')
            )
            ->column(
                TableColumn::text('fixed_price', 'Fixed Price')->sortable()
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
