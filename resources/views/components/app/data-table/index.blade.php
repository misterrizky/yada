@php
    $tableClasses = collect([
        $tableBordered ? 'rounded-xl border border-gray-200 dark:border-white/10' : null,
    ])->filter()->implode(' ');

    $headerClasses = $tableCondensed ? 'py-2 text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400' : '';
    $cellClasses = $tableCondensed ? 'py-2 text-sm' : '';

    $pollingIntervalSeconds = max(5, (int) $pollingInterval);

    $availableColumns = collect($settingsColumns)
        ->filter(fn ($col) => filled($col['field']) && $col['type'] !== 'action');

    $sortableColumns = $availableColumns
        ->filter(fn ($col) => $col['sortable'])
        ->values();

    $filteredColumns = $availableColumns;

    if (filled($columnSearch)) {
        $query = strtolower($columnSearch);
        $filteredColumns = $availableColumns
            ->filter(fn ($col) => str_contains(strtolower($col['label']), $query)
                || str_contains(strtolower($col['field']), $query))
            ->values();
    }
@endphp

<div @if($pollingEnabled) wire:poll.{{ $pollingIntervalSeconds }}s @endif>
    <flux:table :paginate="$rows" class="{{ $tableClasses }}">
        {{-- ===== HEADER ===== --}}
        <flux:table.columns>
            @foreach($columns as $col)
                @if (!$col->isAction())
                    <flux:table.column
                        :sorted="$sortField === $col->field"
                        :direction="$sortDirection"
                        class="{{ $headerClasses }}"
                    >
                        @if($col->sortable && $sortAction)
                            <flux:dropdown>
                                <flux:button variant="ghost">{{ $col->label }}</flux:button>
                                <flux:menu>
                                    <flux:menu.item
                                        icon="arrow-up"
                                        wire:click="{{ $sortAction }}('{{ $col->field }}')">
                                        Sort Asc
                                    </flux:menu.item>
                                    <flux:menu.item
                                        icon="arrow-down"
                                        wire:click="{{ $sortAction }}('{{ $col->field }}')">
                                        Sort Desc
                                    </flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        @else
                            {{ $col->label }}
                        @endif
                    </flux:table.column>
                @else
                    <flux:table.column class="{{ $headerClasses }}">
                        <flux:modal.trigger name="view-setting" wire:click="openViewSettings">
                            <flux:button variant="ghost" icon="cog-8-tooth" tooltip="Settings" />
                        </flux:modal.trigger>

                        <flux:modal name="view-setting" class="md:w-96">
                            <form wire:submit.prevent="saveViewSettings" class="space-y-6">
                                <div>
                                    <flux:heading size="lg">View Settings</flux:heading>
                                    <flux:subheading>Customize how this table is displayed.</flux:subheading>
                                </div>

                                <flux:select wire:model.live="viewSettingsDraft.sortField" label="Default Sort">
                                    <flux:select.option value="">None</flux:select.option>
                                    @foreach($sortableColumns as $column)
                                        <flux:select.option value="{{ $column['field'] }}">
                                            {{ $column['label'] }}
                                        </flux:select.option>
                                    @endforeach
                                </flux:select>

                                <flux:select wire:model.live="viewSettingsDraft.sortDirection" label="Sort Direction">
                                    <flux:select.option value="asc">Ascending</flux:select.option>
                                    <flux:select.option value="desc">Descending</flux:select.option>
                                </flux:select>

                                <flux:checkbox.group
                                    wire:model.live="viewSettingsDraft.visibleColumns"
                                    label="Columns"
                                    variant="cards"
                                    class="flex-col"
                                >
                                    <flux:input
                                        wire:model.live.debounce.200ms="columnSearch"
                                        icon="magnifying-glass"
                                        placeholder="Search columns..."
                                    />

                                    @forelse($filteredColumns as $column)
                                        <flux:checkbox value="{{ $column['field'] }}" wire:key="column-setting-{{ $column['field'] }}">
                                            <flux:checkbox.indicator />
                                            <div class="flex-1">
                                                <flux:heading class="leading-4">{{ $column['label'] }}</flux:heading>
                                                @if($column['sortable'])
                                                    <flux:subheading class="text-xs">Sortable</flux:subheading>
                                                @endif
                                            </div>
                                        </flux:checkbox>
                                    @empty
                                        <div class="rounded-lg border border-dashed border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-500 dark:border-white/10 dark:bg-white/5 dark:text-gray-400">
                                            No columns match your search.
                                        </div>
                                    @endforelse
                                </flux:checkbox.group>

                                <flux:select wire:model.live="viewSettingsDraft.perPage" label="Per Page">
                                    @foreach($perPageOptions as $option)
                                        <flux:select.option value="{{ $option }}">{{ $option }}</flux:select.option>
                                    @endforeach
                                </flux:select>

                                <div class="space-y-3">
                                    <flux:checkbox wire:model.live="viewSettingsDraft.tableBordered" label="Bordered table" />
                                    <flux:checkbox wire:model.live="viewSettingsDraft.tableCondensed" label="Condensed table" />
                                    <flux:checkbox wire:model.live="viewSettingsDraft.pollingEnabled" label="Enable polling" />
                                </div>

                                @if(data_get($viewSettingsDraft, 'pollingEnabled'))
                                    <flux:input
                                        wire:model.live.debounce.300ms="viewSettingsDraft.pollingInterval"
                                        label="Polling Interval"
                                        description:trailing="Interval in seconds between refreshes."
                                        type="number"
                                        min="5"
                                        max="300"
                                    />
                                @endif

                                <div class="flex items-center gap-2">
                                    <flux:button type="button" variant="ghost" wire:click="resetViewSettings">
                                        Reset
                                    </flux:button>
                                    <flux:spacer />
                                    <flux:modal.close>
                                        <flux:button type="button" variant="filled" wire:click="cancelViewSettings">
                                            Cancel
                                        </flux:button>
                                    </flux:modal.close>
                                    <flux:button
                                        type="submit"
                                        variant="primary"
                                        wire:loading.attr="disabled"
                                        wire:target="saveViewSettings"
                                    >
                                        Save changes
                                    </flux:button>
                                </div>
                            </form>
                        </flux:modal>
                    </flux:table.column>
                @endif
            @endforeach
        </flux:table.columns>
        {{-- ===== ROWS ===== --}}
        <flux:table.rows>
            @foreach($rows as $row)
                <flux:table.row wire:key="row-{{ data_get($row, 'id', $loop->index) }}">
                    @foreach($columns as $col)
                        <flux:table.cell class="{{ $cellClasses }}">
                            @if($col->isAction())
                                @if($actionsView)
                                    @include($actionsView, ['row' => $row])
                                @endif
                            @else
                                {!! $col->render($row) !!}
                            @endif
                        </flux:table.cell>
                    @endforeach
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>