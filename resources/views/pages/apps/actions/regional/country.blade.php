<flux:dropdown>
    <flux:button variant="ghost" icon="eye" tooltip="View Currency, Language, State, Timezone" size="sm"/>
    <flux:menu>
        <flux:menu.item :href="route('app.country.show-currency', ['country' => $row->id])" wire:navigate icon="eye">
            View Currency
        </flux:menu.item>
        <flux:menu.item :href="route('app.country.show-language', ['country' => $row->id])" wire:navigate icon="eye">
            View Language
        </flux:menu.item>
        <flux:menu.item :href="route('app.country.show-state', ['country' => $row->id])" wire:navigate icon="eye">
            View State
        </flux:menu.item>
        <flux:menu.item :href="route('app.country.show-timezone', ['country' => $row->id])" wire:navigate icon="eye">
            View Timezone
        </flux:menu.item>
    </flux:menu>
</flux:dropdown>
<flux:dropdown>
    <flux:button variant="ghost" icon="plus" tooltip="Add Currency, Language, State, Timezone" size="sm"/>
    <flux:menu>
        <flux:menu.item icon="plus" wire:click="$dispatch('country-add-currency', { countryId: {{ $row->id }} })">
            Add Currency
        </flux:menu.item>
        <flux:menu.item icon="plus" wire:click="$dispatch('country-add-state', { countryId: {{ $row->id }} })">
            Add State
        </flux:menu.item>
        <flux:menu.item icon="plus" wire:click="$dispatch('country-add-timezone', { countryId: {{ $row->id }} })">
            Add Timezone
        </flux:menu.item>
    </flux:menu>
</flux:dropdown>
<flux:dropdown>
    <flux:button variant="ghost" icon="ellipsis-horizontal" tooltip="Actions" size="sm"/>

    <flux:menu>
        @php
            $deletePayload = [
                'title' => 'Delete Country',
                'message' => 'You are about to delete ' . $row->name . '. This action cannot be reversed.',
                'confirmEvent' => 'country-delete-confirmed',
                'recordId' => $row->id,
                'confirmLabel' => 'Delete',
            ];
        @endphp
        <flux:menu.item icon="pencil-square" wire:click="$dispatch('country-edit', { countryId: {{ $row->id }} })">
            Edit
        </flux:menu.item>

        <flux:menu.separator />
        <flux:menu.item
            variant="danger"
            icon="trash"
            wire:click="$dispatchTo('apps.actions.delete', 'delete-modal-open', {{ \Illuminate\Support\Js::from($deletePayload) }})">
            Delete
        </flux:menu.item>
    </flux:menu>
</flux:dropdown>
