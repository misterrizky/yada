<?php

use App\Models\Master\ProductUnit;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $productUnitId = null;
    public string $code = '';
    public string $name = '';
    public int $is_active = 1;

    public function updatedCode(string $value): void
    {
        $this->code = strtoupper(trim($value));
    }

    #[On('product-unit-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('product-unit-edit')]
    public function startEdit(int $productUnitId): void
    {
        $unit = ProductUnit::query()->findOrFail($productUnitId);

        $this->productUnitId = $unit->id;
        $this->code = (string) $unit->code;
        $this->name = (string) $unit->name;
        $this->is_active = (int) $unit->is_active;

        $this->dispatch('modal-show', name: 'form-product-unit');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->productUnitId !== null;

        $unit = $isUpdate
            ? ProductUnit::query()->findOrFail($this->productUnitId)
            : new ProductUnit();

        if (! $isUpdate) {
            $unit->ulid = (string) Str::ulid();
        }

        $unit->code = $validated['code'];
        $unit->name = $validated['name'];
        $unit->is_active = (int) $validated['is_active'];
        $unit->save();

        $this->productUnitId = $unit->id;

        $this->dispatch('product-unit-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-product-unit');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Product unit updated' : 'Product unit created',
            message: $isUpdate
                ? 'The product unit has been updated.'
                : 'The product unit has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:50', Rule::unique('product_units', 'code')->ignore($this->productUnitId)],
            'name' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'integer', 'in:0,1'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'productUnitId',
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
    name="form-product-unit"
    :title="$productUnitId ? 'Edit Product Unit' : 'New Product Unit'"
    :subheading="$productUnitId ? 'Update product unit details.' : 'Add a new product unit to the system.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Code"
                placeholder="PCS"
                wire:model.live.debounce.300ms="code"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-8">
            <flux:input
                label="Name"
                placeholder="Pieces"
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
