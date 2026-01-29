<flux:kanban.card as="button" :heading="$card['title'] ?? 'Lead'">
    @if (!empty($card['badges']))
        <x-slot name="header">
            <div class="flex flex-wrap gap-2">
                @foreach ($card['badges'] as $badge)
                    <flux:badge :color="$badge['color'] ?? 'zinc'" size="sm">
                        {{ $badge['label'] ?? '' }}
                    </flux:badge>
                @endforeach
            </div>
        </x-slot>
    @endif

    @if (!empty($card['subtitle']))
        <div class="text-sm text-zinc-500">{{ $card['subtitle'] }}</div>
    @endif

    <x-slot name="footer">
        <div class="flex items-center justify-between text-xs text-zinc-500">
            <span>
                {{ filled($card['meta']['owner'] ?? null) ? $card['meta']['owner'] : 'Unassigned' }}
            </span>
            <span>
                {{ filled($card['meta']['value'] ?? null) ? number_format((float) $card['meta']['value'], 0, '.', ',') : '0' }}
            </span>
        </div>
    </x-slot>
</flux:kanban.card>
