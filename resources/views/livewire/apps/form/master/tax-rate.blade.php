<?php

use App\Models\Finance\TaxRate;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $taxRateId = null;
    public string $name = '';
    public string $rate = '0';
    public int $is_default = 0;
    public int $is_active = 1;

    #[On('tax-rate-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('tax-rate-edit')]
    public function startEdit(int $taxRateId): void
    {
        $taxRate = TaxRate::query()->findOrFail($taxRateId);

        $this->taxRateId = $taxRate->id;
        $this->name = (string) $taxRate->name;
        $this->rate = (string) $taxRate->rate;
        $this->is_default = (int) $taxRate->is_default;
        $this->is_active = (int) $taxRate->is_active;

        $this->dispatch('modal-show', name: 'form-tax-rate');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->taxRateId !== null;

        $taxRate = $isUpdate
            ? TaxRate::query()->findOrFail($this->taxRateId)
            : new TaxRate();

        $taxRate->name = $validated['name'];
        $taxRate->rate = (string) $validated['rate'];
        $taxRate->is_default = (int) $validated['is_default'];
        $taxRate->is_active = (int) $validated['is_active'];
        $taxRate->save();

        $this->taxRateId = $taxRate->id;

        $this->dispatch('tax-rate-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-tax-rate');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Tax rate updated' : 'Tax rate created',
            message: $isUpdate
                ? 'The tax rate has been updated.'
                : 'The tax rate has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'numeric', 'min:0'],
            'is_default' => ['required', 'integer', 'in:0,1'],
            'is_active' => ['required', 'integer', 'in:0,1'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'taxRateId',
            'name',
            'rate',
            'is_default',
            'is_active',
        ]);

        $this->rate = '0';
        $this->is_default = 0;
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
    name="form-tax-rate"
    :title="$taxRateId ? 'Edit Tax Rate' : 'New Tax Rate'"
    :subheading="$taxRateId ? 'Update tax rate details.' : 'Add a new tax rate to the system.'"
    submit="save"
    close="resetModal"
>
    <flux:input
        label="Name"
        placeholder="VAT"
        wire:model.live.debounce.300ms="name"
        autocomplete="off"
    />

    <flux:input
        label="Rate (%)"
        type="number"
        min="0"
        step="0.01"
        wire:model.live.debounce.200ms="rate"
    />

    <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <flux:radio.group wire:model="is_default" label="Default">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                <flux:radio value="1" label="Default" />
                <flux:radio value="0" label="Not Default" />
            </div>
        </flux:radio.group>
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
