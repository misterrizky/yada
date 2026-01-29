@props([
    'columns' => [],
    'cardView' => null,
    'columnActionsView' => null,
    'columnFooterView' => null,
    'emptyText' => 'No items yet.',
])

<div class="grid gap-6 lg:grid-cols-3 items-start">
    @foreach ($columns as $column)
        @php
            $cards = $column['cards'] ?? [];
        @endphp
        <flux:kanban.column>
            <flux:kanban.column.header
                :heading="$column['title'] ?? 'Untitled'"
                :subheading="$column['subheading'] ?? null"
                :count="count($cards)"
            >
                @if ($columnActionsView)
                    <x-slot name="actions">
                        @include($columnActionsView, ['column' => $column])
                    </x-slot>
                @endif
            </flux:kanban.column.header>

            <flux:kanban.column.cards>
                @forelse ($cards as $card)
                    @if ($cardView)
                        @include($cardView, ['card' => $card, 'column' => $column])
                    @else
                        <flux:kanban.card :heading="$card['title'] ?? 'Card'">
                            @if (!empty($card['subtitle']))
                                <div class="text-sm text-zinc-500">{{ $card['subtitle'] }}</div>
                            @endif
                        </flux:kanban.card>
                    @endif
                @empty
                    <div class="text-sm text-zinc-500">{{ $emptyText }}</div>
                @endforelse
            </flux:kanban.column.cards>

            @if ($columnFooterView)
                <flux:kanban.column.footer>
                    @include($columnFooterView, ['column' => $column])
                </flux:kanban.column.footer>
            @endif
        </flux:kanban.column>
    @endforeach
</div>
