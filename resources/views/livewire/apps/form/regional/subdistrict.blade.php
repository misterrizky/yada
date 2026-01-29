<?php

use App\Models\Regional\City;
use App\Models\Regional\Subdistrict;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $subdistrictId = null;
    public ?int $cityId = null;
    public string $countryName = '';
    public string $stateName = '';
    public string $cityName = '';
    public string $code = '';
    public string $full_code = '';
    public string $name = '';

    public function mount(): void
    {
        $this->syncCityFromRoute();
    }

    #[On('subdistrict-create')]
    public function startCreate(): void
    {
        $this->resetForm();
        $this->syncCityFromRoute();
    }

    #[On('city-add-subdistrict')]
    public function startCreateFromCity(int $cityId): void
    {
        $this->resetForm(false);
        $city = City::query()->with('state.country')->findOrFail($cityId);
        $this->setCity($city);

        $this->dispatch('modal-show', name: 'form-subdistrict');
    }

    #[On('subdistrict-edit')]
    public function startEdit(int $subdistrictId): void
    {
        $subdistrict = Subdistrict::query()->with('city.state.country')->findOrFail($subdistrictId);

        $this->subdistrictId = $subdistrict->id;
        $this->code = (string) $subdistrict->code;
        $this->full_code = (string) $subdistrict->full_code;
        $this->name = (string) $subdistrict->name;

        if ($subdistrict->city) {
            $this->setCity($subdistrict->city);
        }

        $this->dispatch('modal-show', name: 'form-subdistrict');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());

        $city = City::query()->with('state.country')->findOrFail($validated['cityId']);
        $isUpdate = $this->subdistrictId !== null;

        $subdistrict = $isUpdate
            ? Subdistrict::query()->findOrFail($this->subdistrictId)
            : new Subdistrict();

        $subdistrict->city_id = $city->id;
        $subdistrict->code = $validated['code'];
        $subdistrict->full_code = $validated['full_code'];
        $subdistrict->name = $validated['name'];
        $subdistrict->save();

        $this->subdistrictId = $subdistrict->id;

        $this->dispatch('subdistrict-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-subdistrict');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Subdistrict updated' : 'Subdistrict created',
            message: $isUpdate
                ? 'The subdistrict has been updated.'
                : 'The subdistrict has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'cityId' => ['required', 'integer', 'exists:cities,id'],
            'code' => ['required', 'string', 'max:255'],
            'full_code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    private function syncCityFromRoute(): void
    {
        if ($this->cityId !== null) {
            return;
        }

        $city = request()->route('city');

        if ($city instanceof City) {
            $city->loadMissing('state.country');
            $this->setCity($city);
        }
    }

    private function setCity(City $city): void
    {
        $this->cityId = $city->id;
        $this->cityName = (string) $city->name;
        $this->stateName = '';
        $this->countryName = '';

        $city->loadMissing('state.country');

        if ($city->state) {
            $this->stateName = (string) $city->state->name;
        }

        if ($city->state?->country) {
            $this->countryName = (string) $city->state->country->name;
        }
    }

    private function resetForm(bool $preserveCity = true): void
    {
        $fields = ['subdistrictId', 'code', 'full_code', 'name'];

        if (! $preserveCity) {
            $fields[] = 'cityId';
            $fields[] = 'cityName';
            $fields[] = 'stateName';
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

<flux:modal name="form-subdistrict" flyout variant="floating" class="md:w-lg" @close="resetModal">
    <form wire:submit.prevent="save" class="flex flex-col gap-6">
        <div class="space-y-1">
            <flux:heading size="lg">
                {{ $subdistrictId ? 'Edit Subdistrict' : 'New Subdistrict' }}
            </flux:heading>
            <flux:subheading>
                {{ $cityName !== '' ? "For {$cityName}." : 'Select a city to continue.' }}
            </flux:subheading>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6 dark:border-white/10 dark:bg-white/5">
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
                    <div class="md:col-span-4">
                        <flux:input
                            label="Country"
                            wire:model.live="countryName"
                            placeholder="Country"
                            disabled
                        />
                    </div>
                    <div class="md:col-span-4">
                        <flux:input
                            label="State"
                            wire:model.live="stateName"
                            placeholder="State"
                            disabled
                        />
                    </div>
                    <div class="md:col-span-4">
                        <flux:input
                            label="City"
                            wire:model.live="cityName"
                            placeholder="City"
                            disabled
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
                    <div class="md:col-span-4">
                        <flux:input
                            label="Code"
                            placeholder="3174"
                            wire:model.live.debounce.300ms="code"
                            autocomplete="off"
                        />
                    </div>
                    <div class="md:col-span-8">
                        <flux:input
                            label="Full Code"
                            placeholder="3174.01"
                            wire:model.live.debounce.300ms="full_code"
                            autocomplete="off"
                        />
                    </div>
                </div>

                <flux:input
                    label="Subdistrict Name"
                    placeholder="Kebayoran Baru"
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
