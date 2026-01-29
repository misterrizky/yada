<?php

use App\Models\Master\BloodType;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $bloodTypeId = null;
    public string $name = '';

    #[On('blood-type-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('blood-type-edit')]
    public function startEdit(int $bloodTypeId): void
    {
        $bloodType = BloodType::query()->findOrFail($bloodTypeId);

        $this->bloodTypeId = $bloodType->id;
        $this->name = (string) $bloodType->name;

        $this->dispatch('modal-show', name: 'form-blood-type');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->bloodTypeId !== null;

        $bloodType = $isUpdate
            ? BloodType::query()->findOrFail($this->bloodTypeId)
            : new BloodType();

        $bloodType->name = $validated['name'];
        $bloodType->save();

        $this->bloodTypeId = $bloodType->id;

        $this->dispatch('blood-type-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-blood-type');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Blood type updated' : 'Blood type created',
            message: $isUpdate
                ? 'The blood type has been updated.'
                : 'The blood type has been created.'
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
            'bloodTypeId',
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
    name="form-blood-type"
    :title="$bloodTypeId ? 'Edit Blood Type' : 'New Blood Type'"
    :subheading="$bloodTypeId ? 'Update blood type details.' : 'Add a new blood type to the system.'"
    submit="save"
    close="resetModal"
>
    <flux:input
        label="Name"
        placeholder="A"
        wire:model.live.debounce.300ms="name"
        autocomplete="off"
    />
</x-app.modal.form>
