@props([
    'columns' => [],      // definisi kolom
    'rows' => [],         // data
    'sortBy' => null,
    'sortDir' => 'asc',
])

<div class="overflow-x-auto">
    <flux:table>
        <flux:table.columns>
            @foreach($columns as $key => $col)
                @if($col['visible'])
                    <flux:table.column
                        class="cursor-pointer"
                        wire:click="sortBy('{{ $key }}')"
                    >
                        <div class="flex items-center gap-1">
                            {{ $col['label'] }}
                            @if($sortBy === $key)
                                <flux:icon
                                    name="{{ $sortDir === 'asc' ? 'chevron-up' : 'chevron-down' }}"
                                    size="xs"
                                />
                            @endif
                        </div>
                    </flux:table.column>
                @endif
            @endforeach
        </flux:table.columns>

        <flux:table.rows>
            @forelse($rows as $row)
                <flux:table.row>
                    @foreach($columns as $key => $col)
                        @if($col['visible'])
                            <flux:table.cell>
                                {{ data_get($row, $key) }}
                            </flux:table.cell>
                        @endif
                    @endforeach
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="{{ collect($columns)->where('visible', true)->count() }}">
                        <div class="py-6 text-center text-sm text-gray-400">No data</div>
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>
</div>
