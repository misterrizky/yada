<?php

use App\Models\HR\Certificate;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $certificateId = null;
    public string $name = '';
    public string $description = '';
    public int $is_active = 1;

    #[On('certificate-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('certificate-edit')]
    public function startEdit(int $certificateId): void
    {
        $certificate = Certificate::query()->findOrFail($certificateId);

        $this->certificateId = $certificate->id;
        $this->name = (string) $certificate->name;
        $this->description = (string) ($certificate->description ?? '');
        $this->is_active = (int) $certificate->is_active;

        $this->dispatch('modal-show', name: 'form-certificate');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->certificateId !== null;

        $certificate = $isUpdate
            ? Certificate::query()->findOrFail($this->certificateId)
            : new Certificate();

        $certificate->name = $validated['name'];
        $certificate->description = $this->normalizeNullable($validated['description'] ?? null);
        $certificate->is_active = (int) $validated['is_active'];
        $certificate->save();

        $this->certificateId = $certificate->id;

        $this->dispatch('certificate-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-certificate');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Certificate updated' : 'Certificate created',
            message: $isUpdate
                ? 'The certificate has been updated.'
                : 'The certificate has been created.'
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
            'certificateId',
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

    private function normalizeNullable(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim($value);

        return $value === '' ? null : $value;
    }
};

?>

<x-app.modal.form
    name="form-certificate"
    :title="$certificateId ? 'Edit Certificate' : 'New Certificate'"
    :subheading="$certificateId ? 'Update certificate details.' : 'Add a new certificate to the system.'"
    submit="save"
    close="resetModal"
>
    <flux:input
        label="Name"
        placeholder="AWS Certified Developer"
        wire:model.live.debounce.300ms="name"
        autocomplete="off"
    />

    <flux:textarea
        label="Description"
        placeholder="Optional description"
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
