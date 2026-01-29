<?php

use App\Models\Sales\ContractType;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $contractTypeId = null;
    public string $name = '';
    public string $description = '';
    public int $is_active = 1;

    #[On('contract-type-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('contract-type-edit')]
    public function startEdit(int $contractTypeId): void
    {
        $contractType = ContractType::query()->findOrFail($contractTypeId);

        $this->contractTypeId = $contractType->id;
        $this->name = (string) $contractType->name;
        $this->description = (string) ($contractType->description ?? '');
        $this->is_active = (int) $contractType->is_active;

        $this->dispatch('modal-show', name: 'form-contract-type');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->contractTypeId !== null;

        $contractType = $isUpdate
            ? ContractType::query()->findOrFail($this->contractTypeId)
            : new ContractType();

        $contractType->name = $validated['name'];
        $contractType->description = $validated['description'] !== '' ? $validated['description'] : null;
        $contractType->is_active = (int) $validated['is_active'];
        $contractType->save();

        $this->contractTypeId = $contractType->id;

        $this->dispatch('contract-type-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-contract-type');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Contract type updated' : 'Contract type created',
            message: $isUpdate
                ? 'The contract type has been updated.'
                : 'The contract type has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['required', 'integer', 'in:0,1'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'contractTypeId',
            'name',
            'description',
            'is_active',
        ]);

        $this->is_active = 1;
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-contract-type"
    :title="$contractTypeId ? 'Edit Contract Type' : 'New Contract Type'"
    :subheading="$contractTypeId ? 'Update contract type details.' : 'Add a new contract type to the system.'"
    submit="save"
    close="resetModal"
>
    <flux:input
        label="Name"
        placeholder="Master Service Agreement"
        wire:model.live.debounce.300ms="name"
        autocomplete="off"
    />

    <flux:textarea
        label="Description"
        placeholder="Description..."
        wire:model.live.debounce.300ms="description"
    />

    <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <flux:radio.group wire:model="is_active" label="Status">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                <flux:radio value="1" label="Active" />
                <flux:radio value="0" label="Inactive" />
            </div>
        </flux:radio.group>
    </div>
</x-app.modal.form>
