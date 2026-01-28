<?php

use App\Exports\CountryExport;
use App\Models\Regional\Country;
use App\Models\User\UserFilter;
use App\Tables\CountryTable as TableConfig;
use Maatwebsite\Excel\Facades\Excel;
use function Laravel\Folio\name;
use function Livewire\Volt\{computed, mount, on, state, usesPagination};

usesPagination();
name('app.country.show-language');

state([
    'search' => '',
    'sortField' => '',
    'sortDirection' => 'asc',
    'regions' => [],
    'subregions' => [],
    'perPage' => 10,
    'perPageOptions' => [10, 25, 50, 100],
    'visibleColumns' => fn () => collect(TableConfig::columns())
        ->filter(fn ($col) => ! $col->isAction())
        ->map(fn ($col) => $col->field)
        ->all(),
    'columnSearch' => '',
    'tableBordered' => false,
    'tableCondensed' => false,
    'pollingEnabled' => false,
    'pollingInterval' => 15,
    'viewSettingsDraft' => fn () => [
        'sortField' => '',
        'sortDirection' => 'asc',
        'perPage' => 10,
        'visibleColumns' => collect(TableConfig::columns())
            ->filter(fn ($col) => ! $col->isAction())
            ->map(fn ($col) => $col->field)
            ->all(),
        'tableBordered' => false,
        'tableCondensed' => false,
        'pollingEnabled' => false,
        'pollingInterval' => 15,
    ],
    'columns' => fn () => collect(TableConfig::columns())
        ->map(fn ($col) => $col->toLivewire())
        ->all(),
    'searchableFields' => fn () => (new TableConfig)->searchableFields(),
    'headerDropdownItems' => fn () => [
        ['label' => 'Import Countries', 'icon' => 'arrow-up-tray', 'clickable' => false],
        ['label' => 'Export Countries', 'icon' => 'arrow-down-tray', 'clickable' => true, 'click' => 'country-export'],
    ],
]);

$availableColumnFields = function (\Livewire\Component $component): array {
    return collect($component->columns)
        ->filter(fn ($col) => $col['type'] !== 'action' && filled($col['field']))
        ->pluck('field')
        ->all();
};

$defaultViewSettings = function (\Livewire\Component $component) use ($availableColumnFields): array {
    $defaultPerPage = $component->perPageOptions[0] ?? 10;

    return [
        'sortField' => '',
        'sortDirection' => 'asc',
        'perPage' => $defaultPerPage,
        'visibleColumns' => $availableColumnFields($component),
        'tableBordered' => false,
        'tableCondensed' => false,
        'pollingEnabled' => false,
        'pollingInterval' => 15,
    ];
};

$normalizeViewSettings = function (\Livewire\Component $component, array $settings) use ($availableColumnFields, $defaultViewSettings): array {
    $defaults = $defaultViewSettings($component);
    $perPageOptions = $component->perPageOptions;
    $perPage = (int) ($settings['perPage'] ?? $defaults['perPage']);

    if (! in_array($perPage, $perPageOptions, true)) {
        $perPage = $defaults['perPage'];
    }

    $pollingInterval = (int) ($settings['pollingInterval'] ?? $defaults['pollingInterval']);
    $pollingInterval = max(5, min(300, $pollingInterval));

    $availableFields = $availableColumnFields($component);
    $sortableFields = collect($component->columns)
        ->filter(fn ($col) => $col['type'] !== 'action' && $col['sortable'] && filled($col['field']))
        ->pluck('field')
        ->all();

    $visibleColumns = array_values(array_intersect(
        $settings['visibleColumns'] ?? $defaults['visibleColumns'],
        $availableFields
    ));

    if ($visibleColumns === []) {
        $visibleColumns = $defaults['visibleColumns'];
    }

    $sortField = (string) ($settings['sortField'] ?? $defaults['sortField']);

    if ($sortField !== '' && ! in_array($sortField, $sortableFields, true)) {
        $sortField = $defaults['sortField'];
    }

    $sortDirection = (string) ($settings['sortDirection'] ?? $defaults['sortDirection']);

    if (! in_array($sortDirection, ['asc', 'desc'], true)) {
        $sortDirection = $defaults['sortDirection'];
    }

    return [
        'sortField' => $sortField,
        'sortDirection' => $sortDirection,
        'perPage' => $perPage,
        'visibleColumns' => $visibleColumns,
        'tableBordered' => (bool) ($settings['tableBordered'] ?? $defaults['tableBordered']),
        'tableCondensed' => (bool) ($settings['tableCondensed'] ?? $defaults['tableCondensed']),
        'pollingEnabled' => (bool) ($settings['pollingEnabled'] ?? $defaults['pollingEnabled']),
        'pollingInterval' => $pollingInterval,
    ];
};

$applyViewSettings = function (\Livewire\Component $component, array $settings) use ($normalizeViewSettings): void {
    $settings = $normalizeViewSettings($component, $settings);

    $component->sortField = $settings['sortField'];
    $component->sortDirection = $settings['sortDirection'];
    $component->perPage = $settings['perPage'];
    $component->visibleColumns = $settings['visibleColumns'];
    $component->tableBordered = $settings['tableBordered'];
    $component->tableCondensed = $settings['tableCondensed'];
    $component->pollingEnabled = $settings['pollingEnabled'];
    $component->pollingInterval = $settings['pollingInterval'];
};

$currentViewSettings = function (\Livewire\Component $component): array {
    return [
        'sortField' => $component->sortField,
        'sortDirection' => $component->sortDirection,
        'perPage' => $component->perPage,
        'visibleColumns' => $component->visibleColumns,
        'tableBordered' => $component->tableBordered,
        'tableCondensed' => $component->tableCondensed,
        'pollingEnabled' => $component->pollingEnabled,
        'pollingInterval' => $component->pollingInterval,
    ];
};

$storeUserFilter = function (\Livewire\Component $component) use ($currentViewSettings): void {
    $userId = auth()->id();

    if ($userId === null) {
        return;
    }

    UserFilter::updateOrCreate(
        ['user_id' => $userId, 'key' => 'countries_table'],
        ['value' => [
            'search' => $component->search,
            'regions' => $component->regions,
            'subregions' => $component->subregions,
            'view_settings' => $currentViewSettings($component),
        ]]
    );
};

$export = function (): \Symfony\Component\HttpFoundation\BinaryFileResponse {
    $rows = Country::query()
        ->search($this->search, $this->searchableFields)
        ->when($this->regions, fn ($q) => $q->whereIn('region', $this->regions))
        ->when($this->subregions, fn ($q) => $q->whereIn('subregion', $this->subregions))
        ->get();

    return Excel::download(new CountryExport($rows), 'countries.xlsx');
};

on(['country-saved' => function () {
    // Refresh otomatis terjadi karena state berubah atau dipanggil ulang
}, 'country-export' => $export]);

mount(function () use ($applyViewSettings, $currentViewSettings) {
    $filter = UserFilter::where('user_id', auth()->id())
        ->where('key', 'countries_table')
        ->first();

    if ($filter) {
        $this->search = $filter->value['search'] ?? '';
        $this->regions = $filter->value['regions'] ?? [];
        $this->subregions = $filter->value['subregions'] ?? [];
        $applyViewSettings($this, $filter->value['view_settings'] ?? []);
    }

    $this->viewSettingsDraft = $currentViewSettings($this);
});

$updatedSearch = function () use ($storeUserFilter): void {
    $this->resetPage();

    $storeUserFilter($this);
};

$updatedRegions = function () use ($storeUserFilter): void {
    $this->resetPage();
    $storeUserFilter($this);
};

$updatedSubregions = function () use ($storeUserFilter): void {
    $this->resetPage();
    $storeUserFilter($this);
};

$sortBy = function (string $field): void {
    if ($this->sortField === $field) {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    } else {
        $this->sortField = $field;
        $this->sortDirection = 'asc';
    }

    $this->resetPage();
};

$openViewSettings = function () use ($currentViewSettings): void {
    $this->viewSettingsDraft = $currentViewSettings($this);
    $this->columnSearch = '';
};

$resetViewSettings = function () use ($defaultViewSettings): void {
    $this->viewSettingsDraft = $defaultViewSettings($this);
};

$cancelViewSettings = function () use ($currentViewSettings): void {
    $this->viewSettingsDraft = $currentViewSettings($this);
    $this->columnSearch = '';
    $this->dispatch('modal-close', name: 'view-setting');
};

$saveViewSettings = function () use ($applyViewSettings, $currentViewSettings, $storeUserFilter): void {
    $applyViewSettings($this, $this->viewSettingsDraft);
    $this->resetPage();
    $storeUserFilter($this);
    $this->viewSettingsDraft = $currentViewSettings($this);
    $this->dispatch('modal-close', name: 'view-setting');
};

$deleteCountry = function (Country $country): void {
    $country->delete();

    $this->dispatch(
        'notify',
        title: 'Country deleted',
        message: 'The country has been successfully deleted.'
    );
};
//$table = computed(fn() => (new TableConfig)->columns();
//$columns = computed(fn() => (new TableConfig)->columns();
$countries = computed(function (): \Illuminate\Contracts\Pagination\LengthAwarePaginator {
    return Country::query()
        ->search($this->search, $this->searchableFields)
        ->when($this->regions, fn ($q) => $q->whereIn('region', $this->regions))
        ->when($this->subregions, fn ($q) => $q->whereIn('subregion', $this->subregions))
        ->when($this->sortField, fn ($q) =>
        $q->orderBy($this->sortField, $this->sortDirection)
        )
        ->paginate($this->perPage);
});

$chartData = computed(fn (): \Illuminate\Support\Collection => Country::query()
    ->when($this->regions, fn ($q) => $q->whereIn('region', $this->regions))
    ->selectRaw('region, COUNT(*) as total')
    ->groupBy('region')
    ->orderBy('region')
    ->get()
);
?>
<x-layouts.app :title="__('Regional : Country')">
@volt
    @php
    use App\Tables\TableColumn;

    $columns = collect($this->columns)
        ->filter(fn ($col) => $col['type'] === 'action' || in_array($col['field'], $this->visibleColumns, true))
        ->map(fn ($col) => TableColumn::fromLivewire($col))
        ->all();
    @endphp
    <flux:main>
        @push('app-header-actions')
            <div class="mx-5 flex items-center gap-2">
                <flux:dropdown position="bottom" align="end">
                    <flux:button icon="ellipsis-horizontal" variant="ghost" />
                    <flux:menu>
                        @foreach ($headerDropdownItems as $item)
                            @if($item['clickable'] === true)
                                <flux:menu.item icon="{{ $item['icon'] }}" x-on:click="Livewire.dispatch('{{ $item['click'] }}')">{{ $item['label'] }}</flux:menu.item>
                            @else
                            <flux:menu.item as="button" type="button" icon="{{ $item['icon'] }}">
                                {{ $item['label'] }}
                            </flux:menu.item>
                            @endif
                        @endforeach
                    </flux:menu>
                </flux:dropdown>
                <flux:modal.trigger name="form-country" wire:click="$dispatch('country-create')">
                    <flux:button size="sm" variant="primary" color="sky" icon="plus">
                        Create Country
                    </flux:button>
                </flux:modal.trigger>
            </div>
        @endpush
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="#">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Master</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Regional</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Country</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <flux:heading class="mt-5" size="xl" level="1">Country</flux:heading>
                <flux:input
                    wire:model.live.debounce.500ms="search"
                    size="lg"
                    icon="magnifying-glass"
                    placeholder="Search..."
                    clearable
                />
            </div>
        </div>
        <flux:separator variant="subtle" />
        <div wire:loading wire:target="search,sortBy,perPage,saveViewSettings,gotoPage,nextPage,previousPage">
            <x-app.skeleton.table
                :columns="\App\Tables\CountryTable::columns()"
                :rows="10"
            />
        </div>
        <div wire:loading.remove wire:target="search,sortBy,perPage,saveViewSettings,gotoPage,nextPage,previousPage">
            <x-data-table
                :columns="$columns"
                :rows="$this->countries"
                :sort-field="$this->sortField"
                :sort-direction="$this->sortDirection"
                sort-action="sortBy"
                actions-view="pages.apps.actions.regional.language"
                :settings-columns="$this->columns"
                :view-settings-draft="$this->viewSettingsDraft"
                :per-page-options="$this->perPageOptions"
                :column-search="$this->columnSearch"
                :table-bordered="$this->tableBordered"
                :table-condensed="$this->tableCondensed"
                :polling-enabled="$this->pollingEnabled"
                :polling-interval="$this->pollingInterval"
            />
        </div>
        <livewire:apps.form.country/>
    </flux:main>
@endvolt
</x-layouts.app>
