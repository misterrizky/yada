<?php

use App\Models\Regional\Country;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $countryId = null;

    public string $iso2 = '';
    public string $iso3 = '';
    public string $phone_code = '';
    public string $name = '';
    public string $region = '';
    public string $subregion = '';
    public int $status = 1;

    public function mount(?Country $country = null): void
    {
        if ($country?->exists) {
            $this->fillFromCountry($country);
        }
    }

    // UX: otomatis uppercase ISO
    public function updatedIso2(string $value): void
    {
        $this->iso2 = strtoupper(substr($value, 0, 2));
    }

    public function updatedIso3(string $value): void
    {
        $this->iso3 = strtoupper(substr($value, 0, 3));
    }

    #[On('country-create')]
    public function startCreate(): void
    {
        $this->resetForm();
        // kalau kamu pakai Flux modal open via event, bisa dispatch di parent.
    }

    #[On('country-edit')]
    public function startEdit(int $countryId): void
    {
        $country = Country::query()->findOrFail($countryId);
        $this->fillFromCountry($country);
        $this->dispatch('modal-show', name: 'form-country');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());

        $isUpdate = $this->countryId !== null;

        $country = $isUpdate
            ? Country::query()->findOrFail($this->countryId)
            : new Country();

        $country->fill([
            'iso2' => $validated['iso2'],
            'iso3' => $validated['iso3'],
            'phone_code' => $validated['phone_code'],
            'name' => $validated['name'],
            'region' => $validated['region'],
            'subregion' => $validated['subregion'],
            'status' => (int) $validated['status'],
        ])->save();

        $this->countryId = $country->id;

        $this->dispatch('country-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-country');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Country updated' : 'Country created',
            message: $isUpdate
                ? 'Country details have been updated.'
                : 'Country has been created.'
        );
    }

    private function rules(): array
    {
        // UX: trim + uppercase ISO sudah dibantu updatedIso2/3,
        // tetap validasi ketat dan lebih “aman” untuk update.
        return [
            'iso2' => [
                'required', 'string', 'size:2',
                Rule::unique('countries', 'iso2')->ignore($this->countryId),
            ],
            'iso3' => [
                'required', 'string', 'size:3',
                Rule::unique('countries', 'iso3')->ignore($this->countryId),
            ],
            'phone_code' => ['required', 'string', 'max:5'],
            'name' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'subregion' => ['required', 'string', 'max:255'],
            'status' => ['required', 'integer', 'in:0,1'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'countryId',
            'iso2',
            'iso3',
            'phone_code',
            'name',
            'region',
            'subregion',
            'status',
        ]);

        $this->status = 1;
        $this->resetValidation();
    }
    public function resetModal(): void
    {
        $this->reset([
            'countryId',
            'iso2',
            'iso3',
            'phone_code',
            'name',
            'region',
            'subregion',
            'status',
        ]);

        $this->status = 1;
        $this->resetValidation();
    }

    private function fillFromCountry(Country $country): void
    {
        $this->countryId = $country->id;
        $this->iso2 = (string) $country->iso2;
        $this->iso3 = (string) $country->iso3;
        $this->phone_code = (string) $country->phone_code;
        $this->name = (string) $country->name;
        $this->region = (string) $country->region;
        $this->subregion = (string) $country->subregion;
        $this->status = (int) $country->status;

        $this->resetValidation();
    }
};

?>

<flux:modal name="form-country" flyout variant="floating" class="md:w-lg" @close="resetModal">
    <form wire:submit.prevent="save" class="flex flex-col gap-6">
        {{-- Header --}}
        <div class="space-y-1">
            <flux:heading size="lg">
                {{ $countryId ? 'Edit Country' : 'New Country' }}
            </flux:heading>

            {{-- UX: subheading selaras dan informatif --}}
            <flux:subheading>
                {{ $countryId ? 'update country information below.' : 'Add new countries to the system.' }}
            </flux:subheading>
        </div>

        {{-- Body --}}
        <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6 dark:border-white/10 dark:bg-white/5">
            <div class="space-y-6">
                {{-- Top row --}}
                <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
                    <div class="md:col-span-4">
                        <flux:input
                            label="ISO 2"
                            placeholder="ID"
                            wire:model.live.debounce.200ms="iso2"
                            inputmode="text"
                            autocomplete="off"
                        />
                    </div>

                    <div class="md:col-span-4">
                        <flux:input
                            label="ISO 3"
                            placeholder="IDN"
                            wire:model.live.debounce.200ms="iso3"
                            inputmode="text"
                            autocomplete="off"
                        />
                    </div>

                    <div class="md:col-span-4">
                        <flux:input
                            label="Phone Code"
                            placeholder="62"
                            wire:model.live.debounce.300ms="phone_code"
                            inputmode="numeric"
                            autocomplete="off"
                        />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tanpa tanda “+”. Contoh: 62</p>
                    </div>
                </div>

                {{-- Name --}}
                <div>
                    <flux:input
                        label="Name"
                        placeholder="Indonesia"
                        wire:model.live.debounce.300ms="name"
                        autocomplete="off"
                    />
                </div>

                {{-- Region / Subregion --}}
                <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
                    <div class="md:col-span-6">
                        <flux:input
                            label="Region"
                            placeholder="Asia"
                            wire:model.live.debounce.300ms="region"
                            autocomplete="off"
                        />
                    </div>

                    <div class="md:col-span-6">
                        <flux:input
                            label="Subregion"
                            placeholder="Southeast Asia"
                            wire:model.live.debounce.300ms="subregion"
                            autocomplete="off"
                        />
                    </div>
                </div>

                {{-- Status --}}
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/5">
                    <flux:radio.group wire:model="status" label="Status">
                        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                            <flux:radio value="1" label="Active" />
                            <flux:radio value="0" label="Not Active" />
                        </div>
                    </flux:radio.group>
                </div>
            </div>
        </div>

        {{-- Footer --}}
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
