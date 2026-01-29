<?php

use App\Models\HR\SkillCategory;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $skillCategoryId = null;
    public ?int $parentId = null;
    public string $name = '';
    public int $is_active = 1;

    #[On('skill-category-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('skill-category-edit')]
    public function startEdit(int $skillCategoryId): void
    {
        $skillCategory = SkillCategory::query()->findOrFail($skillCategoryId);

        $this->skillCategoryId = $skillCategory->id;
        $this->parentId = $skillCategory->parent_id !== null ? (int) $skillCategory->parent_id : null;
        $this->name = (string) $skillCategory->name;
        $this->is_active = (int) $skillCategory->is_active;

        $this->dispatch('modal-show', name: 'form-skill-category');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->skillCategoryId !== null;

        $skillCategory = $isUpdate
            ? SkillCategory::query()->findOrFail($this->skillCategoryId)
            : new SkillCategory();

        $skillCategory->parent_id = $validated['parentId'] !== null ? (int) $validated['parentId'] : null;
        $skillCategory->name = $validated['name'];
        $skillCategory->is_active = (int) $validated['is_active'];
        $skillCategory->save();

        $this->skillCategoryId = $skillCategory->id;

        $this->dispatch('skill-category-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-skill-category');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Skill category updated' : 'Skill category created',
            message: $isUpdate
                ? 'The skill category has been updated.'
                : 'The skill category has been created.'
        );
    }

    private function rules(): array
    {
        $notSelf = $this->skillCategoryId ? [$this->skillCategoryId] : [];

        return [
            'parentId' => ['nullable', 'integer', 'exists:skill_categories,id', Rule::notIn($notSelf)],
            'name' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'integer', 'in:0,1'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'skillCategoryId',
            'parentId',
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
    name="form-skill-category"
    :title="$skillCategoryId ? 'Edit Skill Category' : 'New Skill Category'"
    :subheading="$skillCategoryId ? 'Update skill category details.' : 'Add a new skill category to the system.'"
    submit="save"
    close="resetModal"
>
    <flux:select
        wire:model.live="parentId"
        label="Parent Category"
        placeholder="No parent"
    >
        <flux:select.option value="">No parent</flux:select.option>
        @foreach (SkillCategory::query()->when($skillCategoryId, fn ($q) => $q->whereKeyNot($skillCategoryId))->orderBy('name')->get(['id', 'name']) as $parentOption)
            <flux:select.option value="{{ $parentOption->id }}" wire:key="skill-category-parent-{{ $parentOption->id }}">
                {{ $parentOption->name }}
            </flux:select.option>
        @endforeach
    </flux:select>

    <flux:input
        label="Name"
        placeholder="Backend"
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
