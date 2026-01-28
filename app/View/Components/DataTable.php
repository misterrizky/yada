<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTable extends Component
{
    public function __construct(
        public array $columns,
        public mixed $rows,
        public ?string $sortField = null,
        public ?string $sortDirection = null,
        public ?string $sortAction = null,
        public ?string $actionsView = null, // STRING ONLY
        public array $settingsColumns = [],
        public array $viewSettingsDraft = [],
        public array $perPageOptions = [],
        public string $columnSearch = '',
        public bool $tableBordered = false,
        public bool $tableCondensed = false,
        public bool $pollingEnabled = false,
        public int $pollingInterval = 15,
    ) {}

    public function render(): View
    {
        return view('components.app.data-table.index');
    }
}
