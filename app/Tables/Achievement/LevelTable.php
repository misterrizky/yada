<?php

namespace App\Tables\Achievement;

use App\Tables\Table;
use App\Tables\TableColumn;

final class LevelTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('level', 'Level')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('next_level_experience', 'Next Level XP')->sortable()
            )
            ->column(
                TableColumn::text('users_count', 'Users')->sortable()
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
