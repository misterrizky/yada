@php
    $deletePayload = [
        'title' => 'Delete Solution Category',
        'message' => 'You are about to delete ' . $row->name . '. This action cannot be reversed.',
        'confirmEvent' => 'solution-category-delete-confirmed',
        'recordId' => $row->id,
        'confirmLabel' => 'Delete',
    ];
@endphp

<flux:dropdown>
    <flux:button variant="ghost" tooltip="Actions" icon="ellipsis-horizontal" size="sm"/>
    <flux:menu>
        <flux:menu.item
            icon="pencil-square"
            wire:click="$dispatch('solution-category-edit', { solutionCategoryId: {{ $row->id }} })">
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
