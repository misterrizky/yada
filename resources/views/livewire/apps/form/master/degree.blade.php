<?php

use App\Models\Master\Degree;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $degreeId = null;
    public string $code = '';
    public string $name = '';
    public int $order = 0;

    public function updatedCode(string $value): void
    {
        $this->code = strtoupper(trim($value));
    }

    #[On('degree-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('degree-edit')]
    public function startEdit(int $degreeId): void
    {
        $degree = Degree::query()->findOrFail($degreeId);

        $this->degreeId = $degree->id;
        $this->code = (string) $degree->code;
        $this->name = (string) $degree->name;
        $this->order = (int) $degree->order;

        $this->dispatch('modal-show', name: 'form-degree');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->degreeId !== null;

        $degree = $isUpdate
            ? Degree::query()->findOrFail($this->degreeId)
            : new Degree();

        $degree->code = $validated['code'];
        $degree->name = $validated['name'];
        $degree->order = (int) ($validated['order'] ?? 0);
        $degree->save();

        $this->degreeId = $degree->id;

        $this->dispatch('degree-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-degree');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Degree updated' : 'Degree created',
            message: $isUpdate
                ? 'The degree has been updated.'
                : 'The degree has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'degreeId',
            'code',
            'name',
            'order',
        ]);

        $this->order = 0;
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-degree"
    :title="$degreeId ? 'Edit Degree' : 'New Degree'"
    :subheading="$degreeId ? 'Update degree details.' : 'Add a new degree to the system.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Code"
                placeholder="BSC"
                wire:model.live.debounce.200ms="code"
                autocomplete="off"
            />
        </div>

        <div class="md:col-span-8">
            <flux:input
                label="Name"
                placeholder="Bachelor of Science"
                wire:model.live.debounce.300ms="name"
                autocomplete="off"
            />
        </div>
    </div>

    <flux:input
        label="Order"
        type="number"
        min="0"
        wire:model.live.debounce.200ms="order"
    />
</x-app.modal.form>
