<?php

use App\Models\Master\SolutionUnit;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $solutionUnitId = null;
    public string $code = '';
    public string $name = '';
    public int $is_active = 1;

    public function updatedCode(string $value): void
    {
        $this->code = strtoupper(trim($value));
    }

    #[On('solution-unit-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('solution-unit-edit')]
    public function startEdit(int $solutionUnitId): void
    {
        $unit = SolutionUnit::query()->findOrFail($solutionUnitId);

        $this->solutionUnitId = $unit->id;
        $this->code = (string) $unit->code;
        $this->name = (string) $unit->name;
        $this->is_active = (int) $unit->is_active;

        $this->dispatch('modal-show', name: 'form-solution-unit');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->solutionUnitId !== null;

        $unit = $isUpdate
            ? SolutionUnit::query()->findOrFail($this->solutionUnitId)
            : new SolutionUnit();

        if (! $isUpdate) {
            $unit->ulid = (string) Str::ulid();
        }

        $unit->code = $validated['code'];
        $unit->name = $validated['name'];
        $unit->is_active = (int) $validated['is_active'];
        $unit->save();

        $this->solutionUnitId = $unit->id;

        $this->dispatch('solution-unit-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-solution-unit');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Solution unit updated' : 'Solution unit created',
            message: $isUpdate
                ? 'The solution unit has been updated.'
                : 'The solution unit has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:50', Rule::unique('solution_units', 'code')->ignore($this->solutionUnitId)],
            'name' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'integer', 'in:0,1'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'solutionUnitId',
            'code',
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
    name="form-solution-unit"
    :title="$solutionUnitId ? 'Edit Solution Unit' : 'New Solution Unit'"
    :subheading="$solutionUnitId ? 'Update solution unit details.' : 'Add a new solution unit to the system.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Code"
                placeholder="HRS"
                wire:model.live.debounce.300ms="code"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-8">
            <flux:input
                label="Name"
                placeholder="Hours"
                wire:model.live.debounce.300ms="name"
                autocomplete="off"
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
