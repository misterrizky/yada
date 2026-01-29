<?php

namespace App\Tables\Achievement;

use App\Tables\Table;
use App\Tables\TableColumn;

final class AchievementTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('name', 'Name')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('users_count', 'Users')->sortable()
            )
            ->column(
                TableColumn::text('is_secret', 'Secret')->sortable()
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
