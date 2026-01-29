<?php

namespace App\Tables\CRM;

use App\Tables\Table;
use App\Tables\TableColumn;

final class LostReasonTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('name', 'Name')->sortable()->searchable()
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
