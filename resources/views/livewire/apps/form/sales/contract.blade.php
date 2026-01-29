<?php

use App\Models\CRM\Company;
use App\Models\PM\Project;
use App\Models\Regional\Currency;
use App\Models\Sales\Contract;
use App\Models\Sales\ContractType;
use App\Models\Sales\Quotation;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $contractId = null;
    public string $contract_number = '';
    public ?int $companyId = null;
    public ?int $projectId = null;
    public ?int $quotationId = null;
    public ?int $contractTypeId = null;
    public string $subject = '';
    public string $description = '';
    public string $start_date = '';
    public string $end_date = '';
    public ?int $currencyId = null;
    public string $contract_value = '0';
    public string $status = 'draft';
    public string $terms_conditions = '';
    public string $notes = '';
    public string $signed_by_company = '';
    public string $company_signed_at = '';
    public string $signed_by_internal = '';
    public string $internal_signed_at = '';
    public ?int $approvedById = null;

    #[On('contract-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('contract-edit')]
    public function startEdit(int $contractId): void
    {
        $contract = Contract::query()->findOrFail($contractId);

        $this->contractId = $contract->id;
        $this->contract_number = (string) $contract->contract_number;
        $this->companyId = $contract->company_id !== null ? (int) $contract->company_id : null;
        $this->projectId = $contract->project_id !== null ? (int) $contract->project_id : null;
        $this->quotationId = $contract->quotation_id !== null ? (int) $contract->quotation_id : null;
        $this->contractTypeId = $contract->contract_type_id !== null ? (int) $contract->contract_type_id : null;
        $this->subject = (string) $contract->subject;
        $this->description = (string) ($contract->description ?? '');
        $this->start_date = $contract->start_date ? (string) $contract->start_date : '';
        $this->end_date = $contract->end_date ? (string) $contract->end_date : '';
        $this->currencyId = $contract->currency_id !== null ? (int) $contract->currency_id : null;
        $this->contract_value = (string) $contract->contract_value;
        $this->status = (string) $contract->status;
        $this->terms_conditions = (string) ($contract->terms_conditions ?? '');
        $this->notes = (string) ($contract->notes ?? '');
        $this->signed_by_company = (string) ($contract->signed_by_company ?? '');
        $this->company_signed_at = $contract->company_signed_at
            ? Carbon::parse($contract->company_signed_at)->format('Y-m-d\TH:i')
            : '';
        $this->signed_by_internal = (string) ($contract->signed_by_internal ?? '');
        $this->internal_signed_at = $contract->internal_signed_at
            ? Carbon::parse($contract->internal_signed_at)->format('Y-m-d\TH:i')
            : '';
        $this->approvedById = $contract->approved_by !== null ? (int) $contract->approved_by : null;

        $this->dispatch('modal-show', name: 'form-contract');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->contractId !== null;

        $contract = $isUpdate
            ? Contract::query()->findOrFail($this->contractId)
            : new Contract();

        if (! $isUpdate) {
            $contract->ulid = (string) Str::ulid();
        }

        $contract->contract_number = $validated['contract_number'];
        $contract->company_id = $validated['companyId'] !== null ? (int) $validated['companyId'] : null;
        $contract->project_id = $validated['projectId'] !== null ? (int) $validated['projectId'] : null;
        $contract->quotation_id = $validated['quotationId'] !== null ? (int) $validated['quotationId'] : null;
        $contract->contract_type_id = $validated['contractTypeId'] !== null ? (int) $validated['contractTypeId'] : null;
        $contract->subject = $validated['subject'];
        $contract->description = $validated['description'] !== '' ? $validated['description'] : null;
        $contract->start_date = $validated['start_date'] !== '' ? $validated['start_date'] : null;
        $contract->end_date = $validated['end_date'] !== '' ? $validated['end_date'] : null;
        $contract->currency_id = $validated['currencyId'] !== null ? (int) $validated['currencyId'] : null;
        $contract->contract_value = (string) $validated['contract_value'];
        $contract->status = $validated['status'];
        $contract->terms_conditions = $validated['terms_conditions'] !== '' ? $validated['terms_conditions'] : null;
        $contract->notes = $validated['notes'] !== '' ? $validated['notes'] : null;
        $contract->signed_by_company = $validated['signed_by_company'] !== '' ? $validated['signed_by_company'] : null;
        $contract->company_signed_at = $validated['company_signed_at'] !== ''
            ? Carbon::parse($validated['company_signed_at'])->format('Y-m-d H:i:s')
            : null;
        $contract->signed_by_internal = $validated['signed_by_internal'] !== '' ? $validated['signed_by_internal'] : null;
        $contract->internal_signed_at = $validated['internal_signed_at'] !== ''
            ? Carbon::parse($validated['internal_signed_at'])->format('Y-m-d H:i:s')
            : null;
        $contract->approved_by = $validated['approvedById'] !== null ? (int) $validated['approvedById'] : null;

        $userId = auth()->id();
        if (! $isUpdate) {
            $contract->created_by = $userId;
        }
        $contract->updated_by = $userId;

        $contract->save();

        $this->contractId = $contract->id;

        $this->dispatch('contract-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-contract');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Contract updated' : 'Contract created',
            message: $isUpdate
                ? 'The contract has been updated.'
                : 'The contract has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'contract_number' => ['required', 'string', 'max:255', Rule::unique('contracts', 'contract_number')->ignore($this->contractId)],
            'companyId' => ['nullable', 'integer', 'exists:companies,id'],
            'projectId' => ['nullable', 'integer', 'exists:projects,id'],
            'quotationId' => ['nullable', 'integer', 'exists:quotations,id'],
            'contractTypeId' => ['nullable', 'integer', 'exists:contract_types,id'],
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'currencyId' => ['nullable', 'integer', 'exists:currencies,id'],
            'contract_value' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', Rule::in(['draft', 'pending_approval', 'approved', 'active', 'expired', 'terminated'])],
            'terms_conditions' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'signed_by_company' => ['nullable', 'string', 'max:255'],
            'company_signed_at' => ['nullable', 'date'],
            'signed_by_internal' => ['nullable', 'string', 'max:255'],
            'internal_signed_at' => ['nullable', 'date'],
            'approvedById' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'contractId',
            'contract_number',
            'companyId',
            'projectId',
            'quotationId',
            'contractTypeId',
            'subject',
            'description',
            'start_date',
            'end_date',
            'currencyId',
            'contract_value',
            'status',
            'terms_conditions',
            'notes',
            'signed_by_company',
            'company_signed_at',
            'signed_by_internal',
            'internal_signed_at',
            'approvedById',
        ]);

        $this->status = 'draft';
        $this->contract_value = '0';
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-contract"
    :title="$contractId ? 'Edit Contract' : 'New Contract'"
    :subheading="$contractId ? 'Update contract details.' : 'Create a new contract.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Contract Number"
                placeholder="CTR-001"
                wire:model.live.debounce.300ms="contract_number"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-8">
            <flux:input
                label="Subject"
                placeholder="Contract subject"
                wire:model.live.debounce.300ms="subject"
                autocomplete="off"
            />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="companyId"
                label="Company"
                placeholder="Choose company..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No company</flux:select.option>
                @foreach (Company::query()->orderBy('name')->get(['id', 'name']) as $companyOption)
                    <flux:select.option value="{{ $companyOption->id }}" wire:key="contract-company-{{ $companyOption->id }}">
                        {{ $companyOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="projectId"
                label="Project"
                placeholder="Choose project..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No project</flux:select.option>
                @foreach (Project::query()->orderBy('name')->get(['id', 'name']) as $projectOption)
                    <flux:select.option value="{{ $projectOption->id }}" wire:key="contract-project-{{ $projectOption->id }}">
                        {{ $projectOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="quotationId"
                label="Quotation"
                placeholder="Choose quotation..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No quotation</flux:select.option>
                @foreach (Quotation::query()->orderBy('quotation_number')->get(['id', 'quotation_number']) as $quotationOption)
                    <flux:select.option value="{{ $quotationOption->id }}" wire:key="contract-quotation-{{ $quotationOption->id }}">
                        {{ $quotationOption->quotation_number }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:select
                wire:model.live="contractTypeId"
                label="Contract Type"
                placeholder="Choose type..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No contract type</flux:select.option>
                @foreach (ContractType::query()->orderBy('name')->get(['id', 'name']) as $typeOption)
                    <flux:select.option value="{{ $typeOption->id }}" wire:key="contract-type-{{ $typeOption->id }}">
                        {{ $typeOption->name }}
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
                    <flux:select.option value="{{ $currencyOption->id }}" wire:key="contract-currency-{{ $currencyOption->id }}">
                        {{ $currencyOption->code }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-4">
            <flux:select wire:model.live="status" label="Status">
                <flux:select.option value="draft">Draft</flux:select.option>
                <flux:select.option value="pending_approval">Pending Approval</flux:select.option>
                <flux:select.option value="approved">Approved</flux:select.option>
                <flux:select.option value="active">Active</flux:select.option>
                <flux:select.option value="expired">Expired</flux:select.option>
                <flux:select.option value="terminated">Terminated</flux:select.option>
            </flux:select>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Start Date"
                type="date"
                wire:model.live="start_date"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="End Date"
                type="date"
                wire:model.live="end_date"
            />
        </div>
        <div class="md:col-span-4">
            <flux:input
                label="Contract Value"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="contract_value"
            />
        </div>
    </div>

    <flux:textarea
        label="Description"
        placeholder="Description..."
        wire:model.live.debounce.300ms="description"
    />

    <flux:textarea
        label="Terms & Conditions"
        placeholder="Terms..."
        wire:model.live.debounce.300ms="terms_conditions"
    />

    <flux:textarea
        label="Notes"
        placeholder="Notes..."
        wire:model.live.debounce.300ms="notes"
    />

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-6">
            <flux:input
                label="Signed By (Company)"
                placeholder="Company signer"
                wire:model.live.debounce.300ms="signed_by_company"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-6">
            <flux:input
                label="Company Signed At"
                type="datetime-local"
                wire:model.live.debounce.200ms="company_signed_at"
            />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-6">
            <flux:input
                label="Signed By (Internal)"
                placeholder="Internal signer"
                wire:model.live.debounce.300ms="signed_by_internal"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-6">
            <flux:input
                label="Internal Signed At"
                type="datetime-local"
                wire:model.live.debounce.200ms="internal_signed_at"
            />
        </div>
    </div>

    <flux:select
        wire:model.live="approvedById"
        label="Approved By"
        placeholder="Select approver..."
        searchable
        variant="listbox"
    >
        <flux:select.option value="">No approver</flux:select.option>
        @foreach (User::query()->orderBy('name')->get(['id', 'name']) as $userOption)
            <flux:select.option value="{{ $userOption->id }}" wire:key="contract-approved-{{ $userOption->id }}">
                {{ $userOption->name }}
            </flux:select.option>
        @endforeach
    </flux:select>
</x-app.modal.form>
