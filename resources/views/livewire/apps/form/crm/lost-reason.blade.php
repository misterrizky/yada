<?php

use App\Models\CRM\LostReason;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $lostReasonId = null;
    public string $name = '';

    #[On('lost-reason-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('lost-reason-edit')]
    public function startEdit(int $lostReasonId): void
    {
        $lostReason = LostReason::query()->findOrFail($lostReasonId);

        $this->lostReasonId = $lostReason->id;
        $this->name = (string) $lostReason->name;

        $this->dispatch('modal-show', name: 'form-lost-reason');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->lostReasonId !== null;

        $lostReason = $isUpdate
            ? LostReason::query()->findOrFail($this->lostReasonId)
            : new LostReason();

        $lostReason->name = $validated['name'];
        $lostReason->save();

        $this->lostReasonId = $lostReason->id;

        $this->dispatch('lost-reason-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-lost-reason');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Lost reason updated' : 'Lost reason created',
            message: $isUpdate
                ? 'The lost reason has been updated.'
                : 'The lost reason has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'lostReasonId',
            'name',
        ]);

        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-lost-reason"
    :title="$lostReasonId ? 'Edit Lost Reason' : 'New Lost Reason'"
    :subheading="$lostReasonId ? 'Update lost reason details.' : 'Add a new lost reason to the system.'"
    submit="save"
    close="resetModal"
>
    <flux:input
        label="Name"
        placeholder="Budget cut"
        wire:model.live.debounce.300ms="name"
        autocomplete="off"
    />
</x-app.modal.form>
