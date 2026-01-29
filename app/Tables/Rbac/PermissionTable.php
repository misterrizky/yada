<?php

namespace App\Tables\Rbac;

use App\Tables\Table;
use App\Tables\TableColumn;

final class PermissionTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('name', 'Name')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('guard_name', 'Guard')->sortable()->searchable()
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
