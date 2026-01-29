@php
    $deletePayload = [
        'title' => 'Delete Subdistrict',
        'message' => 'You are about to delete ' . $row->name . '. This action cannot be reversed.',
        'confirmEvent' => 'subdistrict-delete-confirmed',
        'recordId' => $row->id,
        'confirmLabel' => 'Delete',
    ];
@endphp

<flux:dropdown>
    <flux:button variant="ghost" tooltip="Actions" icon="ellipsis-horizontal" size="sm"/>
    <flux:menu>
        <flux:menu.item :href="route('app.subdistrict.show-village', ['subdistrict' => $row->id])" wire:navigate icon="eye">
            View Village
        </flux:menu.item>
        <flux:menu.item
            icon="pencil-square"
            wire:click="$dispatch('subdistrict-edit', { subdistrictId: {{ $row->id }} })">
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
