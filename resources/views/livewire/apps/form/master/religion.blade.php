<?php

use App\Models\Master\Religion;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $religionId = null;
    public string $name = '';

    #[On('religion-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('religion-edit')]
    public function startEdit(int $religionId): void
    {
        $religion = Religion::query()->findOrFail($religionId);

        $this->religionId = $religion->id;
        $this->name = (string) $religion->name;

        $this->dispatch('modal-show', name: 'form-religion');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->religionId !== null;

        $religion = $isUpdate
            ? Religion::query()->findOrFail($this->religionId)
            : new Religion();

        $religion->name = $validated['name'];
        $religion->save();

        $this->religionId = $religion->id;

        $this->dispatch('religion-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-religion');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Religion updated' : 'Religion created',
            message: $isUpdate
                ? 'The religion has been updated.'
                : 'The religion has been created.'
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
            'religionId',
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
    name="form-religion"
    :title="$religionId ? 'Edit Religion' : 'New Religion'"
    :subheading="$religionId ? 'Update religion details.' : 'Add a new religion to the system.'"
    submit="save"
    close="resetModal"
>
    <flux:input
        label="Name"
        placeholder="Islam"
        wire:model.live.debounce.300ms="name"
        autocomplete="off"
    />
</x-app.modal.form>
