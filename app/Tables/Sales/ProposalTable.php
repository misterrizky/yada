<?php

namespace App\Tables\Sales;

use App\Tables\Table;
use App\Tables\TableColumn;

final class ProposalTable extends Table
{
    public static function columns(): array
    {
        return (new self)
            ->column(
                TableColumn::text('proposal_number', 'Number')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('title', 'Title')->sortable()->searchable()
            )
            ->column(
                TableColumn::text('lead.name', 'Lead')
            )
            ->column(
                TableColumn::text('company.name', 'Company')
            )
            ->column(
                TableColumn::text('status', 'Status')->sortable()
            )
            ->column(
                TableColumn::text('valid_until', 'Valid Until')->sortable()
            )
            ->column(
                TableColumn::text('total', 'Total')->sortable()
            )
            ->column(
                TableColumn::actions()
            )

            ->get();
    }
}
