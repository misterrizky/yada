@php
    $deletePayload = [
        'title' => 'Delete Level',
        'message' => 'You are about to delete level ' . $row->level . '. This action cannot be reversed.',
        'confirmEvent' => 'level-delete-confirmed',
        'recordId' => $row->id,
        'confirmLabel' => 'Delete',
    ];
@endphp

<flux:dropdown>
    <flux:button variant="ghost" tooltip="Actions" icon="ellipsis-horizontal" size="sm"/>
    <flux:menu>
        <flux:menu.item
            icon="pencil-square"
            wire:click="$dispatch('level-edit', { levelId: {{ $row->id }} })">
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
