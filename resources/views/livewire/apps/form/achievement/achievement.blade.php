<?php

use LevelUp\Experience\Models\Achievement;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $achievementId = null;
    public string $name = '';
    public int $is_secret = 0;
    public string $description = '';
    public string $image = '';

    #[On('achievement-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('achievement-edit')]
    public function startEdit(int $achievementId): void
    {
        $achievement = Achievement::query()->findOrFail($achievementId);

        $this->achievementId = $achievement->id;
        $this->name = (string) $achievement->name;
        $this->is_secret = (int) $achievement->is_secret;
        $this->description = (string) ($achievement->description ?? '');
        $this->image = (string) ($achievement->image ?? '');

        $this->dispatch('modal-show', name: 'form-achievement');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->achievementId !== null;

        $achievement = $isUpdate
            ? Achievement::query()->findOrFail($this->achievementId)
            : new Achievement();

        $achievement->name = $validated['name'];
        $achievement->is_secret = (int) $validated['is_secret'];
        $achievement->description = $this->normalizeNullable($validated['description'] ?? null);
        $achievement->image = $this->normalizeNullable($validated['image'] ?? null);
        $achievement->save();

        $this->achievementId = $achievement->id;

        $this->dispatch('achievement-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-achievement');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Achievement updated' : 'Achievement created',
            message: $isUpdate
                ? 'The achievement has been updated.'
                : 'The achievement has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'is_secret' => ['required', 'integer', 'in:0,1'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'achievementId',
            'name',
            'is_secret',
            'description',
            'image',
        ]);

        $this->is_secret = 0;
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
    name="form-achievement"
    :title="$achievementId ? 'Edit Achievement' : 'New Achievement'"
    :subheading="$achievementId ? 'Update achievement details.' : 'Add a new achievement to the system.'"
    submit="save"
    close="resetModal"
>
    <flux:input
        label="Name"
        placeholder="Level 10"
        wire:model.live.debounce.300ms="name"
        autocomplete="off"
    />

    <flux:textarea
        label="Description"
        placeholder="When a user reaches level 10"
        wire:model.live.debounce.300ms="description"
    />

    <flux:input
        label="Image"
        placeholder="achievements/level-10.png"
        wire:model.live.debounce.300ms="image"
        autocomplete="off"
    />

    <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <flux:radio.group wire:model="is_secret" label="Secret">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                <flux:radio value="0" label="Visible" />
                <flux:radio value="1" label="Secret" />
            </div>
        </flux:radio.group>
    </div>
</x-app.modal.form>
