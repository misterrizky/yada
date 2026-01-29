<?php

use App\Models\CRM\Source;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $sourceId = null;
    public string $name = '';
    public int $is_active = 1;

    #[On('source-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('source-edit')]
    public function startEdit(int $sourceId): void
    {
        $source = Source::query()->findOrFail($sourceId);

        $this->sourceId = $source->id;
        $this->name = (string) $source->name;
        $this->is_active = (int) $source->is_active;

        $this->dispatch('modal-show', name: 'form-source');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->sourceId !== null;

        $source = $isUpdate
            ? Source::query()->findOrFail($this->sourceId)
            : new Source();

        $source->name = $validated['name'];
        $source->is_active = (int) $validated['is_active'];
        $source->save();

        $this->sourceId = $source->id;

        $this->dispatch('source-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-source');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Source updated' : 'Source created',
            message: $isUpdate
                ? 'The source has been updated.'
                : 'The source has been created.'
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
            'sourceId',
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
    name="form-source"
    :title="$sourceId ? 'Edit Source' : 'New Source'"
    :subheading="$sourceId ? 'Update source details.' : 'Add a new source to the system.'"
    submit="save"
    close="resetModal"
>
    <flux:input
        label="Name"
        placeholder="Website"
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
