@php
    $deletePayload = [
        'title' => 'Delete Stage',
        'message' => 'You are about to delete ' . $row->name . '. This action cannot be reversed.',
        'confirmEvent' => 'stage-delete-confirmed',
        'recordId' => $row->id,
        'confirmLabel' => 'Delete',
    ];
@endphp

<flux:dropdown>
    <flux:button variant="ghost" tooltip="Actions" icon="ellipsis-horizontal" size="sm"/>
    <flux:menu>
        <flux:menu.item
            icon="pencil-square"
            wire:click="$dispatch('stage-edit', { stageId: {{ $row->id }} })">
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
