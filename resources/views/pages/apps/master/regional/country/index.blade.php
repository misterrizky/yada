<?php

use App\Exports\CountryExport;
use App\Models\Regional\Country;
use App\Models\User\UserFilter;
use App\Tables\CountryTable as TableConfig;
use Maatwebsite\Excel\Facades\Excel;
use function Laravel\Folio\name;
use function Livewire\Volt\{computed, mount, on, state, usesPagination};

usesPagination();
name('app.country');

state([
    'search' => '',
    'sortField' => '',
    'sortDirection' => 'asc',
    'regions' => [],
    'subregions' => [],
    'table' => fn () => new TableConfig,
    'columns' => fn () => collect(TableConfig::columns())
        ->map(fn ($col) => $col->toLivewire())
        ->all(),
    'searchableFields' => fn () => (new TableConfig)->searchableFields(),
    'headerDropdownItems' => fn() => [['label' => 'Import Countries', 'icon' => 'arrow-up-tray', 'clickable' => false], ['label' => 'Export Countries', 'icon' => 'arrow-down-tray', 'clickable' => true, 'click' => 'country-export']],
]);

$export = function () {
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

mount(function () {
    $filter = UserFilter::where('user_id', auth()->id())
        ->where('key', 'countries_table')
        ->first();

    if ($filter) {
        $this->search = $filter->value['search'] ?? '';
        $this->regions = $filter->value['regions'] ?? [];
        $this->subregions = $filter->value['subregions'] ?? [];
    }
});

$updatedSearch = function () {
    $this->resetPage();

    UserFilter::updateOrCreate(
        ['user_id' => auth()->id(), 'key' => 'countries_table'],
        ['value' => [
            'search' => $this->search,
            'regions' => $this->regions,
            'subregions' => $this->subregions,
        ]]
    );
};

$sortBy = function ($field) {
    if ($this->sortField === $field) {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    } else {
        $this->sortField = $field;
        $this->sortDirection = 'asc';
    }
};

$deleteCountry = function (Country $country) {
    $country->delete();

    $this->dispatch(
        'notify',
        title: 'Country deleted',
        message: 'The country has been successfully deleted.'
    );
};
//$table = computed(fn() => (new TableConfig)->columns();
//$columns = computed(fn() => (new TableConfig)->columns();
$countries = computed(function () {
    return Country::query()
        ->search($this->search, $this->searchableFields)
        ->when($this->regions, fn ($q) => $q->whereIn('region', $this->regions))
        ->when($this->subregions, fn ($q) => $q->whereIn('subregion', $this->subregions))
        ->when($this->sortField, fn ($q) =>
        $q->orderBy($this->sortField, $this->sortDirection)
        )
        ->paginate(10);
});

$chartData = computed(fn () => Country::query()
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
        <div wire:loading wire:target="search,sort,gotoPage,nextPage,previousPage">
            <x-app.skeleton.table
                :columns="\App\Tables\CountryTable::columns()"
                :rows="10"
            />
        </div>
        {{--    <flux:card class="mb-4">--}}
        {{--        <div x-data="regionChart(@json($this->chartData))" x-effect="render(@json($this->chartData))" class="h-64">--}}
        {{--            <canvas x-ref="canvas"></canvas>--}}
        {{--        </div>--}}
        {{--    </flux:card>--}}
        <div wire:loading.remove wire:target="search,sort,gotoPage,nextPage,previousPage">
            <x-data-table
                :columns="$columns"
                :rows="$this->countries"
                :sort-field="$this->sortField"
                :sort-direction="$this->sortDirection"
                sort-action="sortBy"
                actions-view="pages.apps.master.regional.country.actions"
            />
        </div>
        <livewire:apps.form.country/>
    </flux:main>
@endvolt
</x-layouts.app>
