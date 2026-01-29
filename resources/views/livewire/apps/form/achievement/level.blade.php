<?php

use Illuminate\Validation\Rule;
use LevelUp\Experience\Models\Level;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $levelId = null;
    public int $level = 1;
    public ?int $next_level_experience = null;

    #[On('level-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('level-edit')]
    public function startEdit(int $levelId): void
    {
        $level = Level::query()->findOrFail($levelId);

        $this->levelId = $level->id;
        $this->level = (int) $level->level;
        $this->next_level_experience = $level->next_level_experience !== null
            ? (int) $level->next_level_experience
            : null;

        $this->dispatch('modal-show', name: 'form-level');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->levelId !== null;

        $level = $isUpdate
            ? Level::query()->findOrFail($this->levelId)
            : new Level();

        $level->level = (int) $validated['level'];
        $level->next_level_experience = $validated['next_level_experience'] !== null
            ? (int) $validated['next_level_experience']
            : null;
        $level->save();

        $this->levelId = $level->id;

        $this->dispatch('level-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-level');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Level updated' : 'Level created',
            message: $isUpdate
                ? 'The level has been updated.'
                : 'The level has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'level' => ['required', 'integer', 'min:1', Rule::unique('levels', 'level')->ignore($this->levelId)],
            'next_level_experience' => ['nullable', 'integer', 'min:0'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'levelId',
            'level',
            'next_level_experience',
        ]);

        $this->level = 1;
        $this->next_level_experience = null;
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-level"
    :title="$levelId ? 'Edit Level' : 'New Level'"
    :subheading="$levelId ? 'Update level details.' : 'Add a new level to the system.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Level"
                type="number"
                min="1"
                wire:model.live.debounce.200ms="level"
            />
        </div>
        <div class="md:col-span-8">
            <flux:input
                label="Next Level Experience"
                type="number"
                min="0"
                wire:model.live.debounce.200ms="next_level_experience"
            />
        </div>
    </div>
</x-app.modal.form>
