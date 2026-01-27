<flux:table :paginate="$rows">
    {{-- ===== HEADER ===== --}}
    <flux:table.columns>
        @foreach($columns as $col)
            @if (!$col->isAction())
                <flux:table.column
                    :sorted="$sortField === $col->field"
                    :direction="$sortDirection"
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
                <flux:table.column>
                    {{ $col->label }}
                </flux:table.column>
            @endif
        @endforeach
    </flux:table.columns>
    {{-- ===== ROWS ===== --}}
    <flux:table.rows>
        @foreach($rows as $row)
            <flux:table.row>
                @foreach($columns as $col)
                    <flux:table.cell>
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
