<?php

use App\Models\Regional\City;
use App\Models\Regional\State;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $cityId = null;
    public ?int $stateId = null;
    public ?int $countryId = null;
    public string $countryName = '';
    public string $stateName = '';
    public string $name = '';
    public string $code = '';
    public string $type = '';

    public function mount(): void
    {
        $this->syncStateFromRoute();
    }

    #[On('city-create')]
    public function startCreate(): void
    {
        $this->resetForm();
        $this->syncStateFromRoute();
    }

    #[On('state-add-city')]
    public function startCreateFromState(int $stateId): void
    {
        $this->resetForm(false);
        $state = State::query()->with('country')->findOrFail($stateId);
        $this->setState($state);

        $this->dispatch('modal-show', name: 'form-city');
    }

    #[On('city-edit')]
    public function startEdit(int $cityId): void
    {
        $city = City::query()->with('state.country')->findOrFail($cityId);

        $this->cityId = $city->id;
        $this->name = (string) $city->name;
        $this->code = (string) ($city->code ?? '');
        $this->type = (string) ($city->type ?? '');

        if ($city->state) {
            $this->setState($city->state);
        }

        $this->dispatch('modal-show', name: 'form-city');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());

        $state = State::query()->with('country')->findOrFail($validated['stateId']);
        $isUpdate = $this->cityId !== null;

        $city = $isUpdate
            ? City::query()->findOrFail($this->cityId)
            : new City();

        $city->state_id = $state->id;
        $city->country_id = $state->country_id;
        $city->country_code = (string) ($state->country?->iso3 ?? $state->country_code);
        $city->name = $validated['name'];
        $city->code = $validated['code'] !== '' ? $validated['code'] : null;
        $city->type = $validated['type'] !== '' ? $validated['type'] : null;
        $city->save();

        $this->cityId = $city->id;

        $this->dispatch('city-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-city');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'City updated' : 'City created',
            message: $isUpdate
                ? 'The city has been updated.'
                : 'The city has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'stateId' => ['required', 'integer', 'exists:states,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:255'],
        ];
    }

    private function syncStateFromRoute(): void
    {
        if ($this->stateId !== null) {
            return;
        }

        $state = request()->route('state');

        if ($state instanceof State) {
            $state->loadMissing('country');
            $this->setState($state);
        }
    }

    private function setState(State $state): void
    {
        $this->stateId = $state->id;
        $this->stateName = (string) $state->name;
        $this->countryId = $state->country_id;

        $state->loadMissing('country');

        if ($state->country) {
            $this->countryName = (string) $state->country->name;
        }
    }

    private function resetForm(bool $preserveState = true): void
    {
        $fields = ['cityId', 'name', 'code', 'type'];

        if (! $preserveState) {
            $fields[] = 'stateId';
            $fields[] = 'stateName';
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

<flux:modal name="form-city" flyout variant="floating" class="md:w-lg" @close="resetModal">
    <form wire:submit.prevent="save" class="flex flex-col gap-6">
        <div class="space-y-1">
            <flux:heading size="lg">
                {{ $cityId ? 'Edit City' : 'New City' }}
            </flux:heading>
            <flux:subheading>
                {{ $stateName !== '' ? "For {$stateName}." : 'Select a state to continue.' }}
            </flux:subheading>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6 dark:border-white/10 dark:bg-white/5">
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
                    <div class="md:col-span-6">
                        <flux:input
                            label="Country"
                            wire:model.live="countryName"
                            placeholder="Country"
                            disabled
                        />
                    </div>
                    <div class="md:col-span-6">
                        <flux:input
                            label="State"
                            wire:model.live="stateName"
                            placeholder="State"
                            disabled
                        />
                    </div>
                </div>

                <flux:input
                    label="City Name"
                    placeholder="Jakarta"
                    wire:model.live.debounce.300ms="name"
                    autocomplete="off"
                />

                <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
                    <div class="md:col-span-6">
                        <flux:input
                            label="Code"
                            placeholder="JKT"
                            wire:model.live.debounce.300ms="code"
                            autocomplete="off"
                        />
                    </div>
                    <div class="md:col-span-6">
                        <flux:input
                            label="Type"
                            placeholder="Kota"
                            wire:model.live.debounce.300ms="type"
                            autocomplete="off"
                        />
                    </div>
                </div>
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
