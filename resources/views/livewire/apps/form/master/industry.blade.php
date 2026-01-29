<?php

use App\Models\Master\Industry;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $industryId = null;
    public string $name = '';
    public int $is_active = 1;

    #[On('industry-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('industry-edit')]
    public function startEdit(int $industryId): void
    {
        $industry = Industry::query()->findOrFail($industryId);

        $this->industryId = $industry->id;
        $this->name = (string) $industry->name;
        $this->is_active = (int) $industry->is_active;

        $this->dispatch('modal-show', name: 'form-industry');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->industryId !== null;

        $industry = $isUpdate
            ? Industry::query()->findOrFail($this->industryId)
            : new Industry();

        $industry->name = $validated['name'];
        $industry->is_active = (int) $validated['is_active'];
        $industry->save();

        $this->industryId = $industry->id;

        $this->dispatch('industry-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-industry');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Industry updated' : 'Industry created',
            message: $isUpdate
                ? 'The industry has been updated.'
                : 'The industry has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'integer', 'in:0,1'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'industryId',
            'name',
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
    name="form-industry"
    :title="$industryId ? 'Edit Industry' : 'New Industry'"
    :subheading="$industryId ? 'Update industry details.' : 'Add a new industry to the system.'"
    submit="save"
    close="resetModal"
>
    <flux:input
        label="Name"
        placeholder="Technology"
        wire:model.live.debounce.300ms="name"
        autocomplete="off"
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
