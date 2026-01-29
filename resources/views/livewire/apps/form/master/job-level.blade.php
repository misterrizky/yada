<?php

use App\Models\HR\JobLevel;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $jobLevelId = null;
    public string $name = '';
    public string $slug = '';
    public int $sort_order = 0;
    public string $multiplier = '1.000';

    public function updatedName(string $value): void
    {
        if ($this->slug === '') {
            $this->slug = Str::slug($value);
        }
    }

    #[On('job-level-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('job-level-edit')]
    public function startEdit(int $jobLevelId): void
    {
        $jobLevel = JobLevel::query()->findOrFail($jobLevelId);

        $this->jobLevelId = $jobLevel->id;
        $this->name = (string) $jobLevel->name;
        $this->slug = (string) $jobLevel->slug;
        $this->sort_order = (int) $jobLevel->sort_order;
        $this->multiplier = (string) $jobLevel->multiplier;

        $this->dispatch('modal-show', name: 'form-job-level');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->jobLevelId !== null;

        $jobLevel = $isUpdate
            ? JobLevel::query()->findOrFail($this->jobLevelId)
            : new JobLevel();

        $jobLevel->name = $validated['name'];
        $jobLevel->slug = $validated['slug'];
        $jobLevel->sort_order = (int) $validated['sort_order'];
        $jobLevel->multiplier = (string) $validated['multiplier'];
        $jobLevel->save();

        $this->jobLevelId = $jobLevel->id;

        $this->dispatch('job-level-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-job-level');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Job level updated' : 'Job level created',
            message: $isUpdate
                ? 'The job level has been updated.'
                : 'The job level has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('job_levels', 'name')->ignore($this->jobLevelId)],
            'slug' => ['required', 'string', 'max:255', Rule::unique('job_levels', 'slug')->ignore($this->jobLevelId)],
            'sort_order' => ['required', 'integer', 'min:0'],
            'multiplier' => ['required', 'numeric', 'min:0'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'jobLevelId',
            'name',
            'slug',
            'sort_order',
            'multiplier',
        ]);

        $this->sort_order = 0;
        $this->multiplier = '1.000';
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-job-level"
    :title="$jobLevelId ? 'Edit Job Level' : 'New Job Level'"
    :subheading="$jobLevelId ? 'Update job level details.' : 'Add a new job level to the system.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-6">
            <flux:input
                label="Name"
                placeholder="Senior"
                wire:model.live.debounce.300ms="name"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-6">
            <flux:input
                label="Slug"
                placeholder="senior"
                wire:model.live.debounce.300ms="slug"
                autocomplete="off"
            />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Sort Order"
                type="number"
                min="0"
                wire:model.live.debounce.200ms="sort_order"
            />
        </div>
        <div class="md:col-span-8">
            <flux:input
                label="Multiplier"
                type="number"
                step="0.001"
                min="0"
                wire:model.live.debounce.200ms="multiplier"
            />
        </div>
    </div>
</x-app.modal.form>
