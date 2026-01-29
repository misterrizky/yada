<?php

namespace App\Tables\Achievement;

use App\Tables\Table;
use App\Tables\TableColumn;

final class StreakTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('user.name', 'User')
            )
            ->column(
                TableColumn::text('activity.name', 'Activity')
            )
            ->column(
                TableColumn::text('count', 'Count')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('activity_at', 'Activity At')->sortable()
            )
            ->column(
                TableColumn::text('frozen_until', 'Frozen Until')->sortable()
            )
            ->column(
                TableColumn::text('histories_count', 'Histories')->sortable()
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
