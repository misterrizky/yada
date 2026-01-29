<?php

use App\Models\Regional\Country;
use App\Models\Regional\Timezone;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $timezoneId = null;
    public ?int $countryId = null;
    public string $countryName = '';
    public bool $isCountryLocked = false;
    public string $name = '';

    public function mount(): void
    {
        $this->syncCountryFromRoute();
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

    #[On('timezone-create')]
    public function startCreate(): void
    {
        $this->resetForm();
        $this->syncCountryFromRoute();
    }

    #[On('country-add-timezone')]
    public function startCreateFromCountry(int $countryId): void
    {
        $this->resetForm(false);
        $country = Country::query()->findOrFail($countryId);
        $this->setCountry($country);

        $this->dispatch('modal-show', name: 'form-timezone');
    }

    #[On('timezone-edit')]
    public function startEdit(int $timezoneId): void
    {
        $timezone = Timezone::query()->with('country')->findOrFail($timezoneId);
        $this->timezoneId = $timezone->id;
        $this->name = (string) $timezone->name;

        if ($timezone->country) {
            $this->setCountry($timezone->country);
        }

        $this->dispatch('modal-show', name: 'form-timezone');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());

        $country = Country::query()->findOrFail($validated['countryId']);
        $isUpdate = $this->timezoneId !== null;

        $timezone = $isUpdate
            ? Timezone::query()->findOrFail($this->timezoneId)
            : new Timezone();

        $timezone->country_id = $country->id;
        $timezone->name = $validated['name'];
        $timezone->save();

        $this->timezoneId = $timezone->id;

        $this->dispatch('timezone-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-timezone');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Timezone updated' : 'Timezone created',
            message: $isUpdate
                ? 'The timezone has been updated.'
                : 'The timezone has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'countryId' => ['required', 'integer', 'exists:countries,id'],
            'name' => ['required', 'string', 'max:255'],
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
        $fields = ['timezoneId', 'name'];

        if (! $preserveCountry) {
            $fields[] = 'countryId';
            $fields[] = 'countryName';
        }

        $this->reset($fields);
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
    name="form-timezone"
    :title="$timezoneId ? 'Edit Timezone' : 'New Timezone'"
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
                <flux:select.option value="{{ $countryOption->id }}" wire:key="timezone-country-{{ $countryOption->id }}">
                    {{ $countryOption->name }}
                </flux:select.option>
            @endforeach
        </flux:select>
    @endif

    <flux:input
        label="Timezone"
        placeholder="Asia/Jakarta"
        wire:model.live.debounce.300ms="name"
        autocomplete="off"
    />
</x-app.modal.form>
