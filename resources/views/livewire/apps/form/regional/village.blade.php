<?php

use App\Models\Regional\Subdistrict;
use App\Models\Regional\Village;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $villageId = null;
    public ?int $subdistrictId = null;
    public string $countryName = '';
    public string $stateName = '';
    public string $cityName = '';
    public string $subdistrictName = '';
    public string $code = '';
    public string $full_code = '';
    public string $name = '';
    public string $poscode = '';

    public function mount(): void
    {
        $this->syncSubdistrictFromRoute();
    }

    #[On('village-create')]
    public function startCreate(): void
    {
        $this->resetForm();
        $this->syncSubdistrictFromRoute();
    }

    #[On('subdistrict-add-village')]
    public function startCreateFromSubdistrict(int $subdistrictId): void
    {
        $this->resetForm(false);
        $subdistrict = Subdistrict::query()->with('city.state.country')->findOrFail($subdistrictId);
        $this->setSubdistrict($subdistrict);

        $this->dispatch('modal-show', name: 'form-village');
    }

    #[On('village-edit')]
    public function startEdit(int $villageId): void
    {
        $village = Village::query()->with('subdistrict.city.state.country')->findOrFail($villageId);

        $this->villageId = $village->id;
        $this->code = (string) $village->code;
        $this->full_code = (string) $village->full_code;
        $this->name = (string) $village->name;
        $this->poscode = (string) $village->poscode;

        if ($village->subdistrict) {
            $this->setSubdistrict($village->subdistrict);
        }

        $this->dispatch('modal-show', name: 'form-village');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());

        $subdistrict = Subdistrict::query()->with('city.state.country')->findOrFail($validated['subdistrictId']);
        $isUpdate = $this->villageId !== null;

        $village = $isUpdate
            ? Village::query()->findOrFail($this->villageId)
            : new Village();

        $village->subdistrict_id = $subdistrict->id;
        $village->code = $validated['code'];
        $village->full_code = $validated['full_code'];
        $village->name = $validated['name'];
        $village->poscode = $validated['poscode'];
        $village->save();

        $this->villageId = $village->id;

        $this->dispatch('village-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-village');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Village updated' : 'Village created',
            message: $isUpdate
                ? 'The village has been updated.'
                : 'The village has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'subdistrictId' => ['required', 'integer', 'exists:subdistricts,id'],
            'code' => ['required', 'string', 'max:255'],
            'full_code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'poscode' => ['required', 'string', 'max:255'],
        ];
    }

    private function syncSubdistrictFromRoute(): void
    {
        if ($this->subdistrictId !== null) {
            return;
        }

        $subdistrict = request()->route('subdistrict');

        if ($subdistrict instanceof Subdistrict) {
            $subdistrict->loadMissing('city.state.country');
            $this->setSubdistrict($subdistrict);
        }
    }

    private function setSubdistrict(Subdistrict $subdistrict): void
    {
        $this->subdistrictId = $subdistrict->id;
        $this->subdistrictName = (string) $subdistrict->name;
        $this->cityName = '';
        $this->stateName = '';
        $this->countryName = '';

        $subdistrict->loadMissing('city.state.country');

        if ($subdistrict->city) {
            $this->cityName = (string) $subdistrict->city->name;
        }

        if ($subdistrict->city?->state) {
            $this->stateName = (string) $subdistrict->city->state->name;
        }

        if ($subdistrict->city?->state?->country) {
            $this->countryName = (string) $subdistrict->city->state->country->name;
        }
    }

    private function resetForm(bool $preserveSubdistrict = true): void
    {
        $fields = ['villageId', 'code', 'full_code', 'name', 'poscode'];

        if (! $preserveSubdistrict) {
            $fields[] = 'subdistrictId';
            $fields[] = 'subdistrictName';
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

<flux:modal name="form-village" flyout variant="floating" class="md:w-lg" @close="resetModal">
    <form wire:submit.prevent="save" class="flex flex-col gap-6">
        <div class="space-y-1">
            <flux:heading size="lg">
                {{ $villageId ? 'Edit Village' : 'New Village' }}
            </flux:heading>
            <flux:subheading>
                {{ $subdistrictName !== '' ? "For {$subdistrictName}." : 'Select a subdistrict to continue.' }}
            </flux:subheading>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6 dark:border-white/10 dark:bg-white/5">
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
                    <div class="md:col-span-3">
                        <flux:input
                            label="Country"
                            wire:model.live="countryName"
                            placeholder="Country"
                            disabled
                        />
                    </div>
                    <div class="md:col-span-3">
                        <flux:input
                            label="State"
                            wire:model.live="stateName"
                            placeholder="State"
                            disabled
                        />
                    </div>
                    <div class="md:col-span-3">
                        <flux:input
                            label="City"
                            wire:model.live="cityName"
                            placeholder="City"
                            disabled
                        />
                    </div>
                    <div class="md:col-span-3">
                        <flux:input
                            label="Subdistrict"
                            wire:model.live="subdistrictName"
                            placeholder="Subdistrict"
                            disabled
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
                    <div class="md:col-span-4">
                        <flux:input
                            label="Code"
                            placeholder="3174010001"
                            wire:model.live.debounce.300ms="code"
                            autocomplete="off"
                        />
                    </div>
                    <div class="md:col-span-8">
                        <flux:input
                            label="Full Code"
                            placeholder="3174010001"
                            wire:model.live.debounce.300ms="full_code"
                            autocomplete="off"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
                    <div class="md:col-span-8">
                        <flux:input
                            label="Village Name"
                            placeholder="Senayan"
                            wire:model.live.debounce.300ms="name"
                            autocomplete="off"
                        />
                    </div>
                    <div class="md:col-span-4">
                        <flux:input
                            label="Poscode"
                            placeholder="12190"
                            wire:model.live.debounce.300ms="poscode"
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
