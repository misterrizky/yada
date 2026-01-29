<?php

use App\Models\Regional\Language;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $languageId = null;
    public string $code = '';
    public string $name = '';
    public string $name_native = '';
    public string $dir = 'ltr';

    public function updatedCode(string $value): void
    {
        $this->code = strtolower(substr(trim($value), 0, 2));
    }

    #[On('language-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('language-edit')]
    public function startEdit(int $languageId): void
    {
        $language = Language::query()->findOrFail($languageId);
        $this->fillFromLanguage($language);
        $this->dispatch('modal-show', name: 'form-language');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());

        $isUpdate = $this->languageId !== null;

        $language = $isUpdate
            ? Language::query()->findOrFail($this->languageId)
            : new Language();

        $language->code = $validated['code'];
        $language->name = $validated['name'];
        $language->name_native = $validated['name_native'];
        $language->dir = $validated['dir'];
        $language->save();

        $this->languageId = $language->id;

        $this->dispatch('language-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-language');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Language updated' : 'Language created',
            message: $isUpdate
                ? 'The language has been updated.'
                : 'The language has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'code' => ['required', 'string', 'size:2', Rule::unique('languages', 'code')->ignore($this->languageId)],
            'name' => ['required', 'string', 'max:255'],
            'name_native' => ['required', 'string', 'max:255'],
            'dir' => ['required', 'string', 'in:ltr,rtl'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'languageId',
            'code',
            'name',
            'name_native',
            'dir',
        ]);

        $this->dir = 'ltr';
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }

    private function fillFromLanguage(Language $language): void
    {
        $this->languageId = $language->id;
        $this->code = (string) $language->code;
        $this->name = (string) $language->name;
        $this->name_native = (string) $language->name_native;
        $this->dir = (string) $language->dir;

        $this->resetValidation();
    }
};

?>

<x-app.modal.form
    name="form-language"
    :title="$languageId ? 'Edit Language' : 'New Language'"
    :subheading="$languageId ? 'Update language information below.' : 'Add a new language to the system.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Code"
                placeholder="id"
                wire:model.live.debounce.200ms="code"
                inputmode="text"
                autocomplete="off"
            />
        </div>

        <div class="md:col-span-8">
            <flux:input
                label="Name"
                placeholder="Indonesian"
                wire:model.live.debounce.300ms="name"
                autocomplete="off"
            />
        </div>
    </div>

    <div>
        <flux:input
            label="Native Name"
            placeholder="Bahasa Indonesia"
            wire:model.live.debounce.300ms="name_native"
            autocomplete="off"
        />
    </div>

    <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <flux:radio.group wire:model="dir" label="Direction">
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                <flux:radio value="ltr" label="Left to Right" />
                <flux:radio value="rtl" label="Right to Left" />
            </div>
        </flux:radio.group>
    </div>
</x-app.modal.form>
