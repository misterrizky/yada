<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    public function __construct(
        public array $columns,
        public $rows,
        public ?string $sortField = null,
        public ?string $sortDirection = null,
        public ?string $sortAction = null,
        public ?string $actionsView = null, // ✅ STRING ONLY
    ) {}

    public function render()
    {
        return view('components.app.data-table.index');
    }
}
