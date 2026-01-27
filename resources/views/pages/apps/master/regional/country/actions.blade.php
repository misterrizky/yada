<flux:dropdown>
    <flux:button variant="ghost" icon="ellipsis-horizontal" size="sm"/>

    <flux:menu>
        <flux:menu.item
            icon="pencil-square"
            wire:click="$dispatch('country-edit', { countryId: {{ $row->id }} })">
            Edit
        </flux:menu.item>

        <flux:menu.separator />

        <flux:menu.item
            variant="danger"
            icon="trash"
            wire:click="deleteCountry({{ $row->id }})"
            wire:confirm="Are you sure?">
            Delete
        </flux:menu.item>
    </flux:menu>
</flux:dropdown>
