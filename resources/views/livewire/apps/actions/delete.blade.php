<?php

use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public string $title = 'Delete';
    public string $message = 'You are about to delete this data. This action cannot be reversed.';
    public string $confirmEvent = '';
    public string $confirmLabel = 'Delete';
    public ?int $recordId = null;

    #[On('delete-modal-open')]
    public function open(
        string $title,
        string $message,
        string $confirmEvent,
        int $recordId,
        ?string $confirmLabel = null
    ): void {
        $this->title = $title;
        $this->message = $message;
        $this->confirmEvent = $confirmEvent;
        $this->recordId = $recordId;

        if ($confirmLabel !== null && $confirmLabel !== '') {
            $this->confirmLabel = $confirmLabel;
        }

        $this->dispatch('modal-show', name: 'delete');
    }

    public function confirm(): void
    {
        if ($this->recordId === null || $this->confirmEvent === '') {
            return;
        }

        $this->dispatch($this->confirmEvent, recordId: $this->recordId);
    }

    public function resetModal(): void
    {
        $this->title = 'Delete';
        $this->message = 'You are about to delete this data. This action cannot be reversed.';
        $this->confirmEvent = '';
        $this->confirmLabel = 'Delete';
        $this->recordId = null;
    }
};

?>

<flux:modal name="delete" class="min-w-[22rem]" @close="resetModal">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ $title }}</flux:heading>
            <flux:text class="mt-2">{!! nl2br(e($message)) !!}</flux:text>
        </div>
        <div class="flex gap-2">
            <flux:spacer />
            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>
            <flux:button
                variant="danger"
                wire:click="confirm"
                wire:loading.attr="disabled"
                wire:target="confirm"
                :disabled="$recordId === null || $confirmEvent === ''"
            >
                <span wire:loading.remove wire:target="confirm">{{ $confirmLabel }}</span>
                <span wire:loading wire:target="confirm">Deleting...</span>
            </flux:button>
        </div>
    </div>
</flux:modal>
