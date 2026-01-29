<?php

namespace App\Tables\CRM;

use App\Tables\Table;
use App\Tables\TableColumn;

final class LeadTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('name', 'Name')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('code', 'Code')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('company_name', 'Company Name')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('source.name', 'Source')
            )
            ->column(
                TableColumn::text('stage.name', 'Stage')
            )
            ->column(
                TableColumn::text('industry.name', 'Industry')
            )
            ->column(
                TableColumn::text('user.name', 'Owner')
            )
            ->column(
                TableColumn::text('company.name', 'Company')
            )
            ->column(
                TableColumn::text('value', 'Value')->sortable()
            )
            ->column(
                TableColumn::actions()
            )
            ->get();
    }
}
