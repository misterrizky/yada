<?php

use App\Models\CRM\Company;
use App\Models\CRM\Lead;
use App\Models\Regional\Currency;
use App\Models\Sales\Proposal;
use App\Models\Sales\Quotation;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?int $quotationId = null;
    public string $quotation_number = '';
    public ?int $leadId = null;
    public ?int $companyId = null;
    public ?int $proposalId = null;
    public string $title = '';
    public string $description = '';
    public string $valid_until = '';
    public string $status = 'draft';
    public ?int $currencyId = null;
    public string $sub_total = '0';
    public string $discount = '0';
    public string $discount_type = 'fixed';
    public string $tax = '0';
    public string $total = '0';
    public string $terms_conditions = '';
    public string $notes = '';
    public ?int $approvedById = null;

    #[On('quotation-create')]
    public function startCreate(): void
    {
        $this->resetForm();
    }

    #[On('quotation-edit')]
    public function startEdit(int $quotationId): void
    {
        $quotation = Quotation::query()->findOrFail($quotationId);

        $this->quotationId = $quotation->id;
        $this->quotation_number = (string) $quotation->quotation_number;
        $this->leadId = $quotation->lead_id !== null ? (int) $quotation->lead_id : null;
        $this->companyId = $quotation->company_id !== null ? (int) $quotation->company_id : null;
        $this->proposalId = $quotation->proposal_id !== null ? (int) $quotation->proposal_id : null;
        $this->title = (string) $quotation->title;
        $this->description = (string) ($quotation->description ?? '');
        $this->valid_until = $quotation->valid_until ? (string) $quotation->valid_until : '';
        $this->status = (string) $quotation->status;
        $this->currencyId = $quotation->currency_id !== null ? (int) $quotation->currency_id : null;
        $this->sub_total = (string) $quotation->sub_total;
        $this->discount = (string) $quotation->discount;
        $this->discount_type = (string) $quotation->discount_type;
        $this->tax = (string) $quotation->tax;
        $this->total = (string) $quotation->total;
        $this->terms_conditions = (string) ($quotation->terms_conditions ?? '');
        $this->notes = (string) ($quotation->notes ?? '');
        $this->approvedById = $quotation->approved_by !== null ? (int) $quotation->approved_by : null;

        $this->dispatch('modal-show', name: 'form-quotation');
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());
        $isUpdate = $this->quotationId !== null;

        $quotation = $isUpdate
            ? Quotation::query()->findOrFail($this->quotationId)
            : new Quotation();

        if (! $isUpdate) {
            $quotation->ulid = (string) Str::ulid();
        }

        $quotation->quotation_number = $validated['quotation_number'];
        $quotation->lead_id = $validated['leadId'] !== null ? (int) $validated['leadId'] : null;
        $quotation->company_id = $validated['companyId'] !== null ? (int) $validated['companyId'] : null;
        $quotation->proposal_id = $validated['proposalId'] !== null ? (int) $validated['proposalId'] : null;
        $quotation->title = $validated['title'];
        $quotation->description = $validated['description'] !== '' ? $validated['description'] : null;
        $quotation->valid_until = $validated['valid_until'] !== '' ? $validated['valid_until'] : null;
        $quotation->status = $validated['status'];
        $quotation->currency_id = $validated['currencyId'] !== null ? (int) $validated['currencyId'] : null;
        $quotation->sub_total = (string) $validated['sub_total'];
        $quotation->discount = (string) $validated['discount'];
        $quotation->discount_type = $validated['discount_type'];
        $quotation->tax = (string) $validated['tax'];
        $quotation->total = (string) $validated['total'];
        $quotation->terms_conditions = $validated['terms_conditions'] !== '' ? $validated['terms_conditions'] : null;
        $quotation->notes = $validated['notes'] !== '' ? $validated['notes'] : null;
        $quotation->approved_by = $validated['approvedById'] !== null ? (int) $validated['approvedById'] : null;

        $userId = auth()->id();
        if (! $isUpdate) {
            $quotation->created_by = $userId;
        }
        $quotation->updated_by = $userId;

        $quotation->save();

        $this->quotationId = $quotation->id;

        $this->dispatch('quotation-saved', isNew: ! $isUpdate);
        $this->dispatch('modal-close', name: 'form-quotation');
        $this->dispatch(
            'notify',
            title: $isUpdate ? 'Quotation updated' : 'Quotation created',
            message: $isUpdate
                ? 'The quotation has been updated.'
                : 'The quotation has been created.'
        );
    }

    private function rules(): array
    {
        return [
            'quotation_number' => ['required', 'string', 'max:255', Rule::unique('quotations', 'quotation_number')->ignore($this->quotationId)],
            'leadId' => ['nullable', 'integer', 'exists:leads,id'],
            'companyId' => ['nullable', 'integer', 'exists:companies,id'],
            'proposalId' => ['nullable', 'integer', 'exists:proposals,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'valid_until' => ['nullable', 'date'],
            'status' => ['required', 'string', Rule::in(['draft', 'sent', 'accepted', 'declined', 'expired', 'invoiced'])],
            'currencyId' => ['nullable', 'integer', 'exists:currencies,id'],
            'sub_total' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0'],
            'discount_type' => ['required', 'string', Rule::in(['fixed', 'percent'])],
            'tax' => ['required', 'numeric', 'min:0'],
            'total' => ['required', 'numeric', 'min:0'],
            'terms_conditions' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'approvedById' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }

    private function resetForm(): void
    {
        $this->reset([
            'quotationId',
            'quotation_number',
            'leadId',
            'companyId',
            'proposalId',
            'title',
            'description',
            'valid_until',
            'status',
            'currencyId',
            'sub_total',
            'discount',
            'discount_type',
            'tax',
            'total',
            'terms_conditions',
            'notes',
            'approvedById',
        ]);

        $this->status = 'draft';
        $this->sub_total = '0';
        $this->discount = '0';
        $this->discount_type = 'fixed';
        $this->tax = '0';
        $this->total = '0';
        $this->resetValidation();
    }

    public function resetModal(): void
    {
        $this->resetForm();
    }
};

?>

<x-app.modal.form
    name="form-quotation"
    :title="$quotationId ? 'Edit Quotation' : 'New Quotation'"
    :subheading="$quotationId ? 'Update quotation details.' : 'Create a new quotation.'"
    submit="save"
    close="resetModal"
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Quotation Number"
                placeholder="QTN-001"
                wire:model.live.debounce.300ms="quotation_number"
                autocomplete="off"
            />
        </div>
        <div class="md:col-span-8">
            <flux:input
                label="Title"
                placeholder="Quotation Title"
                wire:model.live.debounce.300ms="title"
                autocomplete="off"
            />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-6">
            <flux:select
                wire:model.live="leadId"
                label="Lead"
                placeholder="Choose lead..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No lead</flux:select.option>
                @foreach (Lead::query()->orderBy('name')->get(['id', 'name']) as $leadOption)
                    <flux:select.option value="{{ $leadOption->id }}" wire:key="quotation-lead-{{ $leadOption->id }}">
                        {{ $leadOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="md:col-span-6">
            <flux:select
                wire:model.live="companyId"
                label="Company"
                placeholder="Choose company..."
                searchable
                variant="listbox"
            >
                <flux:select.option value="">No company</flux:select.option>
                @foreach (Company::query()->orderBy('name')->get(['id', 'name']) as $companyOption)
                    <flux:select.option value="{{ $companyOption->id }}" wire:key="quotation-company-{{ $companyOption->id }}">
                        {{ $companyOption->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <flux:select
        wire:model.live="proposalId"
        label="Proposal"
        placeholder="Choose proposal..."
        searchable
        variant="listbox"
    >
        <flux:select.option value="">No proposal</flux:select.option>
        @foreach (Proposal::query()->orderBy('proposal_number')->get(['id', 'proposal_number']) as $proposalOption)
            <flux:select.option value="{{ $proposalOption->id }}" wire:key="quotation-proposal-{{ $proposalOption->id }}">
                {{ $proposalOption->proposal_number }}
            </flux:select.option>
        @endforeach
    </flux:select>

    <flux:textarea
        label="Description"
        placeholder="Description..."
        wire:model.live.debounce.300ms="description"
    />

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-4">
            <flux:input
                label="Valid Until"
                type="date"
                wire:model.live="valid_until"
            />
        </div>
        <div class="md:col-span-4">
            <flux:select wire:model.live="status" label="Status">
                <flux:select.option value="draft">Draft</flux:select.option>
                <flux:select.option value="sent">Sent</flux:select.option>
                <flux:select.option value="accepted">Accepted</flux:select.option>
                <flux:select.option value="declined">Declined</flux:select.option>
                <flux:select.option value="expired">Expired</flux:select.option>
                <flux:select.option value="invoiced">Invoiced</flux:select.option>
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
                    <flux:select.option value="{{ $currencyOption->id }}" wire:key="quotation-currency-{{ $currencyOption->id }}">
                        {{ $currencyOption->code }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-12">
        <div class="md:col-span-3">
            <flux:input
                label="Sub Total"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="sub_total"
            />
        </div>
        <div class="md:col-span-3">
            <flux:input
                label="Discount"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="discount"
            />
        </div>
        <div class="md:col-span-3">
            <flux:select wire:model.live="discount_type" label="Discount Type">
                <flux:select.option value="fixed">Fixed</flux:select.option>
                <flux:select.option value="percent">Percent</flux:select.option>
            </flux:select>
        </div>
        <div class="md:col-span-3">
            <flux:input
                label="Tax"
                type="number"
                min="0"
                step="0.01"
                wire:model.live.debounce.200ms="tax"
            />
        </div>
    </div>

    <flux:input
        label="Total"
        type="number"
        min="0"
        step="0.01"
        wire:model.live.debounce.200ms="total"
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

    <flux:select
        wire:model.live="approvedById"
        label="Approved By"
        placeholder="Select approver..."
        searchable
        variant="listbox"
    >
        <flux:select.option value="">No approver</flux:select.option>
        @foreach (User::query()->orderBy('name')->get(['id', 'name']) as $userOption)
            <flux:select.option value="{{ $userOption->id }}" wire:key="quotation-approved-{{ $userOption->id }}">
                {{ $userOption->name }}
            </flux:select.option>
        @endforeach
    </flux:select>
</x-app.modal.form>
