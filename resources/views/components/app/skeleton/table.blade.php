@props([
    'columns' => [],
    'rows' => 10,
])

<flux:skeleton.group animate="shimmer">
    <flux:table>
        <flux:table.columns>
            @foreach ($columns as $col)
                <flux:table.column>
                    <flux:skeleton class="h-4 w-24" />
                </flux:table.column>
            @endforeach
        </flux:table.columns>

        <flux:table.rows>
            @for ($i = 0; $i < $rows; $i++)
                <flux:table.row>
                    @foreach ($columns as $col)
                        <flux:table.cell>
                            @switch($col->type ?? 'text')
                                @case('badge')
                                    <flux:skeleton class="h-6 w-20 rounded-full" />
                                    @break

                                @case('action')
                                    <flux:skeleton class="h-8 w-16 rounded-md" />
                                    @break

                                @default
                                    <flux:skeleton class="h-4 w-full" />
                            @endswitch
                        </flux:table.cell>
                    @endforeach
                </flux:table.row>
            @endfor
        </flux:table.rows>
    </flux:table>
</flux:skeleton.group>
