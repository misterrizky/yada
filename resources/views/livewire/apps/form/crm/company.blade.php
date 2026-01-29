<?php

use App\Models\CRM\Company;
use App\Models\CRM\Source;
use App\Models\Master\Industry;
use App\Models\Regional\Currency;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $companyId = null;
    public string $code = '';
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $website = '';
    public string $email_procurement = '';
    public string $phone_procurement = '';
    public string $website_procurement = '';
    public string $tax_number = '';
    public string $notes = '';
    public string $status = 'active';
    public ?int $industryId = null;
    public ?int $currencyId = null;
    public ?int $sourceId = null;
    public ?int $accountManagerId = null;

    #[On('company-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('company-edit')]
    public function startEdit(int $companyId): void
    {
        $company = Company::query()->findOrFail($companyId);

        $this->companyId = $company->id;
        $this->code = (string) ($company->code ?? '');
        $this->name = (string) $company->name;
        $this->email = (string) ($company->email ?? '');
        $this->phone = (string) ($company->phone ?? '');
        $this->website = (string) ($company->website ?? '');
        $this->email_procurement = (string) ($company->email_procurement ?? '');
        $this->phone_procurement = (string) ($company->phone_procurement ?? '');
        $this->website_procurement = (string) ($company->website_procurement ?? '');
        $this->tax_number = (string) ($company->tax_number ?? '');
        $this->notes = (string) ($company->notes ?? '');
        $this->status = (string) $company->status;
        $this->industryId = $company->industry_id !== null ? (int) $company->industry_id : null;
        $this->currencyId = $company->currency_id !== null ? (int) $company->currency_id : null;
        $this->sourceId = $company->source_id !== null ? (int) $company->source_id : null;
        $this->accountManagerId = $company->account_manager_id !== null ? (int) $company->account_manager_id : null;

        $this->dispatch('modal-show', name: 'form-company');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->companyId !== null;

        $company = $isUpdate
            ? Company::query()->findOrFail($this->companyId)
            : new Company();

        if (! $isUpdate) {
            $company->ulid = (string) Str::ulid();
        }

        $company->code = $validated['code'] !== '' ? $validated['code'] : null;
        $company->name = $validated['name'];
        $company->email = $validated['email'] !== '' ? $validated['email'] : null;
        $company->phone = $validated['phone'] !== '' ? $validated['phone'] : null;
        $company->website = $validated['website'] !== '' ? $validated['website'] : null;
        $company->email_procurement = $validated['email_procurement'] !== '' ? $validated['email_procurement'] : null;
        $company->phone_procurement = $validated['phone_procurement'] !== '' ? $validated['phone_procurement'] : null;
        $company->website_procurement = $validated['website_procurement'] !== '' ? $validated['website_procurement'] : null;
        $company->tax_number = $validated['tax_number'] !== '' ? $validated['tax_number'] : null;
        $company->notes = $validated['notes'] !== '' ? $validated['notes'] : null;
        $company->status = $validated['status'];
        $company->industry_id = $validated['industryId'] !== null ? (int) $validated['industryId'] : null;
        $company->currency_id = $validated['currencyId'] !== null ? (int) $validated['currencyId'] : null;
        $company->source_id = $validated['sourceId'] !== null ? (int) $validated['sourceId'] : null;
        $company->account_manager_id = $validated['accountManagerId'] !== null ? (int) $validated['accountManagerId'] : null;

        $userId = auth()->id();
        if (! $isUpdate) {
            $company->created_by = $userId;
        }
        $company->updated_by = $userId;

        $company->save();

        $this->companyId = $company->id;

        $this->dispatch('company-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-company');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Company updated' : 'Company created',
            message: $isUpdate
                ? 'The company has been updated.'
                : 'The company has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'code' => ['nullable', 'string', 'max:255', Rule::unique('companies', 'code')->ignore($this->companyId)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'website' => ['nullable', 'string', 'max:255'],
            'email_procurement' => ['nullable', 'email', 'max:255'],
            'phone_procurement' => ['nullable', 'string', 'max:50'],
            'website_procurement' => ['nullable', 'string', 'max:255'],
            'tax_number' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'string', Rule::in(['active', 'inactive', 'blocked'])],
            'industryId' => ['nullable', 'integer', 'exists:industries,id'],
            'currencyId' => ['nullable', 'integer', 'exists:currencies,id'],
            'sourceId' => ['nullable', 'integer', 'exists:sources,id'],
            'accountManagerId' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'companyId',
            'code',
            'name',
            'email',
            'phone',
            'website',
            'email_procurement',
            'phone_procurement',
            'website_procurement',
            'tax_number',
            'notes',
            'status',
            'industryId',
            'currencyId',
            'sourceId',
            'accountManagerId',
        ]);

        $this->status = 'active';
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-company"
    :title="$companyId ? 'Edit Company' : 'New Company'"
    :subheading="$companyId ? 'Update company details.' : 'Add a new company to CRM.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Code"
                placeholder="COMP-001"
                wire:model.live.debounce.300ms="code"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-8">
            <flux:input
                label="Name"
                placeholder="Company name"
                wire:model.live.debounce.300ms="name"
                autocomplete="off"
            />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Email"
                type="email"
                placeholder="info@company.com"
                wire:model.live.debounce.300ms="email"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Phone"
                placeholder="Phone number"
                wire:model.live.debounce.300ms="phone"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Website"
                placeholder="https://"
                wire:model.live.debounce.300ms="website"
                autocomplete="off"
            />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Procurement Email"
                type="email"
                placeholder="procurement@company.com"
                wire:model.live.debounce.300ms="email_procurement"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Procurement Phone"
                placeholder="Procurement phone"
                wire:model.live.debounce.300ms="phone_procurement"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Procurement Website"
                placeholder="https://"
                wire:model.live.debounce.300ms="website_procurement"
                autocomplete="off"
            />
        </div>
    </div>

    <flux:input
        label="Tax Number"
        placeholder="Tax number"
        wire:model.live.debounce.300ms="tax_number"
        autocomplete="off"
    />

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="industryId"
                label="Industry"
                placeholder="Choose industry..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No industry</flux:select.option>
                @foreach (Industry::query()->orderBy('name')->get(['id', 'name']) as $industryOption)
                    <flux:select.option value="{{ $industryOption->id }}" wire:key="company-industry-{{ $industryOption->id }}">
                        {{ $industryOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="currencyId"
                label="Currency"
                placeholder="Choose currency..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No currency</flux:select.option>
                @foreach (Currency::query()->orderBy('code')->get(['id', 'code']) as $currencyOption)
                    <flux:select.option value="{{ $currencyOption->id }}" wire:key="company-currency-{{ $currencyOption->id }}">
                        {{ $currencyOption->code }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="sourceId"
                label="Source"
                placeholder="Choose source..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No source</flux:select.option>
                @foreach (Source::query()->orderBy('name')->get(['id', 'name']) as $sourceOption)
                    <flux:select.option value="{{ $sourceOption->id }}" wire:key="company-source-{{ $sourceOption->id }}">
                        {{ $sourceOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-6">
            <flux:select
                wire:model.live="accountManagerId"
                label="Account Manager"
                placeholder="Choose account manager..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No account manager</flux:select.option>
                @foreach (User::query()->orderBy('name')->get(['id', 'name']) as $userOption)
                    <flux:select.option value="{{ $userOption->id }}" wire:key="company-account-manager-{{ $userOption->id }}">
                        {{ $userOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-6">
            <flux:select wire:model.live="status" label="Status">
                <flux:select.option value="active">Active</flux:select.option>
                <flux:select.option value="inactive">Inactive</flux:select.option>
                <flux:select.option value="blocked">Blocked</flux:select.option>
            </flux:select>
        </div>
    </div>

    <flux:textarea
        label="Notes"
        placeholder="Notes..."
        wire:model.live.debounce.300ms="notes"
    />
</x-app.modal.form>
