@props([
    'columns' => 5,
    'rows' => 5,
])

<flux:skeleton.group animate="shimmer">
    <flux:table>
        <flux:table.columns>
            @if (is_int($columns))
                @foreach (range(1, $columns) as $column)
                    <flux:table.column>
                        <flux:skeleton.line />
                    </flux:table.column>
                @endforeach
            @else
                @foreach ($columns as $column)
                    <flux:table.column>{{ $column }}</flux:table.column>
                @endforeach
            @endif
        </flux:table.columns>
        <flux:table.rows>
            @foreach (range(1, $rows) as $row)
                <flux:table.row wire:key="skeleton-row-{{ $row }}">
                    @php
                        $columnCount = is_int($columns) ? $columns : count($columns);
                    @endphp

                    @foreach (range(1, $columnCount) as $cell)
                        <flux:table.cell>
                            @if ($loop->first)
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
