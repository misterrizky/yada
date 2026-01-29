<?php

use App\Models\Regional\Country;
use App\Models\Regional\Currency;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $currencyId = null;
    public ?int $countryId = null;
    public string $countryName = '';
    public bool $isCountryLocked = false;

    public string $name = '';
    public string $code = '';
    public int $precision = 2;
    public string $symbol = '';
    public string $symbol_native = '';
    public int $symbol_first = 1;
    public string $decimal_mark = '.';
    public string $thousands_separator = ',';

    public function mount(): void
    {
        $this->syncCountryFromRoute();
    }

    public function updatedCode(string $value): void
    {
        $this->code = strtoupper(trim($value));
    }

    public function updatedCountryId(?string $value): void
    {
        if ($value === null || $value === '') {
            $this->countryName = '';
            return;
        }

        $country = Country::query()->find((int) $value);
        $this->countryName = $country ? (string) $country->name : '';
    }

    #[On('currency-create')]
    public function startCreate(): void
    {
        $this->resetForm();
        $this->syncCountryFromRoute();
    }

    #[On('country-add-currency')]
    public function startCreateFromCountry(int $countryId): void
    {
        $this->resetForm(false);
        $country = Country::query()->findOrFail($countryId);
        $this->setCountry($country);

        $this->dispatch('modal-show', name: 'form-currency');
    }

    #[On('currency-edit')]
    public function startEdit(int $currencyId): void
    {
        $currency = Currency::query()->with('country')->findOrFail($currencyId);

        $this->currencyId = $currency->id;
        $this->name = (string) $currency->name;
        $this->code = (string) $currency->code;
        $this->precision = (int) $currency->precision;
        $this->symbol = (string) $currency->symbol;
        $this->symbol_native = (string) $currency->symbol_native;
        $this->symbol_first = (int) $currency->symbol_first;
        $this->decimal_mark = (string) $currency->decimal_mark;
        $this->thousands_separator = (string) $currency->thousands_separator;

        if ($currency->country) {
            $this->setCountry($currency->country);
        }

        $this->dispatch('modal-show', name: 'form-currency');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());

        $country = Country::query()->findOrFail($validated['countryId']);
        $isUpdate = $this->currencyId !== null;

        $currency = $isUpdate
            ? Currency::query()->findOrFail($this->currencyId)
            : new Currency();

        $currency->country_id = $country->id;
        $currency->name = $validated['name'];
        $currency->code = $validated['code'];
        $currency->precision = (int) $validated['precision'];
        $currency->symbol = $validated['symbol'];
        $currency->symbol_native = $validated['symbol_native'];
        $currency->symbol_first = (int) $validated['symbol_first'];
        $currency->decimal_mark = $validated['decimal_mark'];
        $currency->thousands_separator = $validated['thousands_separator'];
        $currency->save();

        $this->currencyId = $currency->id;

        $this->dispatch('currency-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-currency');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Currency updated' : 'Currency created',
            message: $isUpdate
                ? 'The currency has been updated.'
                : 'The currency has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'countryId' => ['required', 'integer', 'exists:countries,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:10'],
            'precision' => ['required', 'integer', 'min:0', 'max:10'],
            'symbol' => ['required', 'string', 'max:10'],
            'symbol_native' => ['required', 'string', 'max:10'],
            'symbol_first' => ['required', 'integer', 'in:0,1'],
            'decimal_mark' => ['required', 'string', 'size:1'],
            'thousands_separator' => ['required', 'string', 'size:1'],
        ];
    }

    private function syncCountryFromRoute(): void
    {
        if ($this->countryId !== null) {
            return;
        }

        $country = request()->route('country');

        if ($country instanceof Country) {
            $this->setCountry($country);
        }
    }

    private function setCountry(Country $country): void
    {
        $this->countryId = $country->id;
        $this->countryName = (string) $country->name;
        $this->isCountryLocked = true;
    }

    private function resetForm(bool $preserveCountry = true): void
    {
        $fields = [
            'currencyId',
            'name',
            'code',
            'precision',
            'symbol',
            'symbol_native',
            'symbol_first',
            'decimal_mark',
            'thousands_separator',
        ];

        if (! $preserveCountry) {
            $fields[] = 'countryId';
            $fields[] = 'countryName';
        }

        $this->reset($fields);

        $this->precision = 2;
        $this->symbol_first = 1;
        $this->decimal_mark = '.';
        $this->thousands_separator = ',';
        $this->isCountryLocked = false;

        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-currency"
    :title="$currencyId ? 'Edit Currency' : 'New Currency'"
    :subheading="$countryName !== '' ? 'For ' . $countryName . '.' : 'Select a country to continue.'"
    submit="save"
    close="resetModal"
>
    @if ($isCountryLocked)
        <flux:input
            label="Country"
            wire:model.live="countryName"
            placeholder="Country"
            disabled
        />
    @else
        <flux:select
            wire:model.live="countryId"
            variant="listbox"
            label="Country"
            searchable
            placeholder="Choose country..."
        >
            @foreach (\App\Models\Regional\Country::query()->orderBy('name')->get() as $countryOption)
                <flux:select.option value="{{ $countryOption->id }}" wire:key="currency-country-{{ $countryOption->id }}">
                    {{ $countryOption->name }}
                </flux:select.option>
            @endforeach
        </flux:select>
    @endif

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Code"
                placeholder="USD"
                wire:model.live.debounce.300ms="code"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-8">
            <flux:input
                label="Name"
                placeholder="US Dollar"
                wire:model.live.debounce.300ms="name"
                autocomplete="off"
            />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Precision"
                type="number"
                min="0"
                max="10"
                wire:model.live.debounce.300ms="precision"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Symbol"
                placeholder="$"
                wire:model.live.debounce.300ms="symbol"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Symbol Native"
                placeholder="$"
                wire:model.live.debounce.300ms="symbol_native"
                autocomplete="off"
            />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-6">
            <flux:input
                label="Decimal Mark"
                placeholder="."
                wire:model.live.debounce.300ms="decimal_mark"
                maxlength="1"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-6">
            <flux:input
                label="Thousands Separator"
                placeholder=","
                wire:model.live.debounce.300ms="thousands_separator"
                maxlength="1"
                autocomplete="off"
            />
        </div>
    </div>

    <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <flux:radio.group wire:model="symbol_first" label="Symbol Position">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                <flux:radio value="1" label="Before amount" />
                <flux:radio value="0" label="After amount" />
            </div>
        </flux:radio.group>
    </div>
</x-app.modal.form>
