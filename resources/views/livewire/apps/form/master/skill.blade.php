<?php

use App\Models\HR\Skill;
use App\Models\HR\SkillCategory;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $skillId = null;
    public ?int $skillCategoryId = null;
    public string $name = '';
    public int $is_active = 1;

    #[On('skill-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('skill-edit')]
    public function startEdit(int $skillId): void
    {
        $skill = Skill::query()->findOrFail($skillId);

        $this->skillId = $skill->id;
        $this->skillCategoryId = $skill->skill_category_id !== null ? (int) $skill->skill_category_id : null;
        $this->name = (string) $skill->name;
        $this->is_active = (int) $skill->is_active;

        $this->dispatch('modal-show', name: 'form-skill');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->skillId !== null;

        $skill = $isUpdate
            ? Skill::query()->findOrFail($this->skillId)
            : new Skill();

        $skill->skill_category_id = $validated['skillCategoryId'] !== null
            ? (int) $validated['skillCategoryId']
            : null;
        $skill->name = $validated['name'];
        $skill->is_active = (int) $validated['is_active'];
        $skill->save();

        $this->skillId = $skill->id;

        $this->dispatch('skill-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-skill');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Skill updated' : 'Skill created',
            message: $isUpdate
                ? 'The skill has been updated.'
                : 'The skill has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'skillCategoryId' => ['nullable', 'integer', 'exists:skill_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'integer', 'in:0,1'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'skillId',
            'skillCategoryId',
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
    name="form-skill"
    :title="$skillId ? 'Edit Skill' : 'New Skill'"
    :subheading="$skillId ? 'Update skill details.' : 'Add a new skill to the system.'"
    submit="save"
    close="resetModal"
>
    <flux:select
        wire:model.live="skillCategoryId"
        label="Category"
        placeholder="Choose category..."
    >
        <flux:select.option value="">No category</flux:select.option>
        @foreach (SkillCategory::query()->orderBy('name')->get(['id', 'name']) as $categoryOption)
            <flux:select.option value="{{ $categoryOption->id }}" wire:key="skill-category-{{ $categoryOption->id }}">
                {{ $categoryOption->name }}
            </flux:select.option>
        @endforeach
    </flux:select>

    <flux:input
        label="Name"
        placeholder="Laravel"
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
