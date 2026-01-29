<?php

use App\Models\Master\Solution;
use App\Models\Master\SolutionCategory;
use App\Models\Master\SolutionUnit;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $solutionId = null;
    public ?int $categoryId = null;
    public ?int $unitId = null;
    public string $code = '';
    public string $name = '';
    public string $short_desc = '';
    public string $long_desc = '';
    public string $thumbnail = '';
    public string $hourly_rate = '0';
    public string $daily_rate = '0';
    public string $fixed_price = '0';
    public string $tax_rate = '0';
    public int $is_active = 1;

    #[On('solution-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('solution-edit')]
    public function startEdit(int $solutionId): void
    {
        $solution = Solution::query()->findOrFail($solutionId);

        $this->solutionId = $solution->id;
        $this->categoryId = $solution->category_id !== null ? (int) $solution->category_id : null;
        $this->unitId = $solution->unit_id !== null ? (int) $solution->unit_id : null;
        $this->code = (string) ($solution->code ?? '');
        $this->name = (string) $solution->name;
        $this->short_desc = (string) ($solution->short_desc ?? '');
        $this->long_desc = (string) ($solution->long_desc ?? '');
        $this->thumbnail = (string) ($solution->thumbnail ?? '');
        $this->hourly_rate = (string) $solution->hourly_rate;
        $this->daily_rate = (string) $solution->daily_rate;
        $this->fixed_price = (string) $solution->fixed_price;
        $this->tax_rate = (string) $solution->tax_rate;
        $this->is_active = (int) $solution->is_active;

        $this->dispatch('modal-show', name: 'form-solution');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->solutionId !== null;

        $solution = $isUpdate
            ? Solution::query()->findOrFail($this->solutionId)
            : new Solution();

        if (! $isUpdate) {
            $solution->ulid = (string) Str::ulid();
        }

        $solution->category_id = $validated['categoryId'] !== null ? (int) $validated['categoryId'] : null;
        $solution->unit_id = $validated['unitId'] !== null ? (int) $validated['unitId'] : null;
        $solution->code = $validated['code'] !== '' ? $validated['code'] : null;
        $solution->name = $validated['name'];
        $solution->short_desc = $validated['short_desc'] !== '' ? $validated['short_desc'] : null;
        $solution->long_desc = $validated['long_desc'] !== '' ? $validated['long_desc'] : null;
        $solution->thumbnail = $validated['thumbnail'] !== '' ? $validated['thumbnail'] : null;
        $solution->hourly_rate = (string) $validated['hourly_rate'];
        $solution->daily_rate = (string) $validated['daily_rate'];
        $solution->fixed_price = (string) $validated['fixed_price'];
        $solution->tax_rate = (string) $validated['tax_rate'];
        $solution->is_active = (int) $validated['is_active'];
        $solution->save();

        $this->solutionId = $solution->id;

        $this->dispatch('solution-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-solution');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Solution updated' : 'Solution created',
            message: $isUpdate
                ? 'The solution has been updated.'
                : 'The solution has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'categoryId' => ['nullable', 'integer', 'exists:solution_categories,id'],
            'unitId' => ['nullable', 'integer', 'exists:solution_units,id'],
            'code' => ['nullable', 'string', 'max:255', Rule::unique('solutions', 'code')->ignore($this->solutionId)],
            'name' => ['required', 'string', 'max:255'],
            'short_desc' => ['nullable', 'string'],
            'long_desc' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'string', 'max:255'],
            'hourly_rate' => ['required', 'numeric', 'min:0'],
            'daily_rate' => ['required', 'numeric', 'min:0'],
            'fixed_price' => ['required', 'numeric', 'min:0'],
            'tax_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'is_active' => ['required', 'integer', 'in:0,1'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'solutionId',
            'categoryId',
            'unitId',
            'code',
            'name',
            'short_desc',
            'long_desc',
            'thumbnail',
            'hourly_rate',
            'daily_rate',
            'fixed_price',
            'tax_rate',
            'is_active',
        ]);

        $this->hourly_rate = '0';
        $this->daily_rate = '0';
        $this->fixed_price = '0';
        $this->tax_rate = '0';
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
    name="form-solution"
    :title="$solutionId ? 'Edit Solution' : 'New Solution'"
    :subheading="$solutionId ? 'Update solution details.' : 'Add a new solution to the system.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-6">
            <flux:select
                wire:model.live="categoryId"
                label="Category"
                placeholder="Choose category..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No category</flux:select.option>
                @foreach (SolutionCategory::query()->orderBy('name')->get(['id', 'name']) as $categoryOption)
                    <flux:select.option value="{{ $categoryOption->id }}" wire:key="solution-category-{{ $categoryOption->id }}">
                        {{ $categoryOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-6">
            <flux:select
                wire:model.live="unitId"
                label="Unit"
                placeholder="Choose unit..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No unit</flux:select.option>
                @foreach (SolutionUnit::query()->orderBy('name')->get(['id', 'name']) as $unitOption)
                    <flux:select.option value="{{ $unitOption->id }}" wire:key="solution-unit-{{ $unitOption->id }}">
                        {{ $unitOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Code"
                placeholder="SOL-001"
                wire:model.live.debounce.300ms="code"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-8">
            <flux:input
                label="Name"
                placeholder="Solution Name"
                wire:model.live.debounce.300ms="name"
                autocomplete="off"
            />
        </div>
    </div>

    <flux:input
        label="Thumbnail URL"
        placeholder="https://..."
        wire:model.live.debounce.300ms="thumbnail"
        autocomplete="off"
    />

    <flux:textarea
        label="Short Description"
        placeholder="Short description..."
        wire:model.live.debounce.300ms="short_desc"
    />

    <flux:textarea
        label="Long Description"
        placeholder="Long description..."
        wire:model.live.debounce.300ms="long_desc"
    />

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-3">
            <flux:input
                label="Hourly Rate"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="hourly_rate"
            />
        </div>
        <div class="md:col-span-3">
            <flux:input
                label="Daily Rate"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="daily_rate"
            />
        </div>
        <div class="md:col-span-3">
            <flux:input
                label="Fixed Price"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="fixed_price"
            />
        </div>
        <div class="md:col-span-3">
            <flux:input
                label="Tax Rate (%)"
                type="number"
                min="0"
                max="100"
                step="0.01"
                wire:model.live.debounce.200ms="tax_rate"
            />
        </div>
    </div>

    <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <flux:radio.group wire:model="is_active" label="Status">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                <flux:radio value="1" label="Active" />
                <flux:radio value="0" label="Inactive" />
            </div>
        </flux:radio.group>
    </div>
</x-app.modal.form>
