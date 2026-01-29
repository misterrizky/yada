<?php

use App\Models\Regional\Country;
use App\Models\Regional\State;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $stateId = null;
    public ?int $countryId = null;
    public string $countryName = '';
    public string $name = '';

    public function mount(): void
    {
        $this->syncCountryFromRoute();
    }

    #[On('state-create')]
    public function startCreate(): void
    {
        $this->resetForm();
        $this->syncCountryFromRoute();
    }

    #[On('country-add-state')]
    public function startCreateFromCountry(int $countryId): void
    {
        $this->resetForm(false);
        $country = Country::query()->findOrFail($countryId);
        $this->setCountry($country);

        $this->dispatch('modal-show', name: 'form-state');
    }

    #[On('state-edit')]
    public function startEdit(int $stateId): void
    {
        $state = State::query()->with('country')->findOrFail($stateId);
        $this->stateId = $state->id;
        $this->name = (string) $state->name;

        if ($state->country) {
            $this->setCountry($state->country);
        }

        $this->dispatch('modal-show', name: 'form-state');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());

        $country = Country::query()->findOrFail($validated['countryId']);
        $isUpdate = $this->stateId !== null;

        $state = $isUpdate
            ? State::query()->findOrFail($this->stateId)
            : new State();

        $state->country_id = $country->id;
        $state->country_code = (string) $country->iso3;
        $state->name = $validated['name'];
        $state->save();

        $this->stateId = $state->id;

        $this->dispatch('state-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-state');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'State updated' : 'State created',
            message: $isUpdate
                ? 'The state has been updated.'
                : 'The state has been created.'
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
    }

    private function resetForm(bool $preserveCountry = true): void
    {
        $fields = ['stateId', 'name'];

        if (! $preserveCountry) {
            $fields[] = 'countryId';
            $fields[] = 'countryName';
        }

        $this->reset($fields);
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<flux:modal name="form-state" flyout variant="floating" class="md:w-lg" @close="resetModal">
    <form wire:submit.prevent="save" class="flex flex-col gap-6">
        <div class="space-y-1">
            <flux:heading size="lg">
                {{ $stateId ? 'Edit State' : 'New State' }}
            </flux:heading>
            <flux:subheading>
                {{ $countryName !== '' ? "For {$countryName}." : 'Select a country to continue.' }}
            </flux:subheading>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6 dark:border-white/10 dark:bg-white/5">
            <div class="space-y-6">
                <flux:input
                    label="Country"
                    wire:model.live="countryName"
                    placeholder="Country"
                    disabled
                />

                <flux:input
                    label="State Name"
                    placeholder="Jakarta"
                    wire:model.live.debounce.300ms="name"
                    autocomplete="off"
                />
            </div>
        </div>

        <div class="flex items-center justify-end gap-2">
            <flux:modal.close>
                <flux:button variant="filled" type="button">
                    Cancel
                </flux:button>
            </flux:modal.close>

            <flux:button
                type="submit"
                variant="primary"
                wire:loading.attr="disabled"
                wire:target="save"
            >
                <span wire:loading.remove wire:target="save">Save</span>
                <span wire:loading wire:target="save">Saving...</span>
            </flux:button>
        </div>
    </form>
</flux:modal>
