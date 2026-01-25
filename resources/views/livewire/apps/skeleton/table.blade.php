@php
$columns = $columns ?? ['Customer', 'Date', 'Status', 'Amount'];
$rows = $rows ?? 5;
@endphp

<flux:skeleton.group animate="shimmer">
    <flux:table>
        <flux:table.columns>
            @foreach ($columns as $column)
                <flux:table.column>{{ $column }}</flux:table.column>
            @endforeach
        </flux:table.columns>
        <flux:table.rows>
            @foreach (range(1, $rows) as $row)
                <flux:table.row wire:key="skeleton-row-{{ $row }}">
                    @foreach ($columns as $index => $column)
                        <flux:table.cell>
                            @if ($index === 0)
                                <div class="flex items-center gap-2">
                                    <flux:skeleton class="rounded-full size-5" />
                                    <div class="flex-1">
                                        <flux:skeleton.line style="width: {{ rand(50, 100) }}%" />
                                    </div>
                                </div>
                            @else
                                <flux:skeleton.line />
                            @endif
                        </flux:table.cell>
                    @endforeach
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</flux:skeleton.group>
