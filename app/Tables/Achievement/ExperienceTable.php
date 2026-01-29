<?php

namespace App\Tables\Achievement;

use App\Tables\Table;
use App\Tables\TableColumn;

final class ExperienceTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('user.name', 'User')
            )
            ->column(
                TableColumn::text('status.level', 'Level')
            )
            ->column(
                TableColumn::text('experience_points', 'Points')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('audits_count', 'Audits')->sortable()
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
