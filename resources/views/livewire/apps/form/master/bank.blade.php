<?php

use App\Models\Master\Bank;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $bankId = null;
    public string $code = '';
    public string $name = '';
    public ?string $swift_code = '';
    public int $is_active = 1;

    public function updatedCode(string $value): void
    {
        $this->code = strtoupper(trim($value));
    }

    #[On('bank-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('bank-edit')]
    public function startEdit(int $bankId): void
    {
        $bank = Bank::query()->findOrFail($bankId);
        $this->fillFromBank($bank);
        $this->dispatch('modal-show', name: 'form-bank');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());

        $isUpdate = $this->bankId !== null;

        $bank = $isUpdate
            ? Bank::query()->findOrFail($this->bankId)
            : new Bank();

        $bank->code = $validated['code'];
        $bank->name = $validated['name'];
        $bank->swift_code = $this->normalizeSwiftCode($validated['swift_code'] ?? null);
        $bank->is_active = (int) $validated['is_active'];
        $bank->save();

        $this->bankId = $bank->id;

        $this->dispatch('bank-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-bank');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Bank updated' : 'Bank created',
            message: $isUpdate
                ? 'The bank has been updated.'
                : 'The bank has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:50', Rule::unique('banks', 'code')->ignore($this->bankId)],
            'name' => ['required', 'string', 'max:255'],
            'swift_code' => ['nullable', 'string', 'max:255'],
            'is_active' => ['required', 'integer', 'in:0,1'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'bankId',
            'code',
            'name',
            'swift_code',
            'is_active',
        ]);

        $this->is_active = 1;
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }

    private function fillFromBank(Bank $bank): void
    {
        $this->bankId = $bank->id;
        $this->code = (string) $bank->code;
        $this->name = (string) $bank->name;
        $this->swift_code = $bank->swift_code !== null ? (string) $bank->swift_code : '';
        $this->is_active = (int) $bank->is_active;

        $this->resetValidation();
    }

    private function normalizeSwiftCode(?string $value): ?string
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
    name="form-bank"
    :title="$bankId ? 'Edit Bank' : 'New Bank'"
    :subheading="$bankId ? 'Update bank information below.' : 'Add a new bank to the system.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Code"
                placeholder="BCA"
                wire:model.live.debounce.200ms="code"
                inputmode="text"
                autocomplete="off"
            />
        </div>

        <div class="md:col-span-8">
            <flux:input
                label="Name"
                placeholder="Bank Central Asia"
                wire:model.live.debounce.300ms="name"
                autocomplete="off"
            />
        </div>
    </div>

    <div>
        <flux:input
            label="Swift Code"
            placeholder="CENAIDJA"
            wire:model.live.debounce.300ms="swift_code"
            autocomplete="off"
        />
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
