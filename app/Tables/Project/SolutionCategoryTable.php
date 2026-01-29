<?php

namespace App\Tables\Project;

use App\Tables\Table;
use App\Tables\TableColumn;

final class SolutionCategoryTable extends Table
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
                TableColumn::text('parent.name', 'Parent')
            )
            ->column(
                TableColumn::text('order', 'Order')->sortable()
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
